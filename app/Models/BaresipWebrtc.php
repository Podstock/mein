<?php

namespace App\Models;

use App\Events\WebrtcSDP;
use App\Events\WebrtcSDPVideo;
use App\Events\WebrtcTalk;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use PhpMqtt\Client\Facades\MQTT;

class BaresipWebrtc
{
    public static function room_baresip_id($room_slug, $operator)
    {
        if ($room_slug === 'echo')
            return 'echo';

        $room = Room::whereSlug($room_slug)->firstOrFail();

        if (empty($room->baresip)) {
            $baresip = Baresip::whereNull('room_id')->firstOrFail();
            $baresip->room_id = $room->id;
            $baresip->save();
            $room = $room->fresh();
        }

        if ($operator === 'inc')
            $room->baresip?->inc_users();
        if ($operator === 'dec')
            $room->baresip?->dec_users();

        return $room->baresip?->id;
    }

    public static function command($id, $cmd, $arg = NULL, $user_id = NULL)
    {
        $params = "";
        if (!empty($arg))
            $params = "," . $arg;

        if (empty($user_id))
            $user_id = auth()->user()->id;

        $json = [
            'command' => "$cmd",
            'params' => $user_id . $params,
            'token' => strval(auth()->user()->id)
        ];
        MQTT::publish("/baresip/$id/command/", json_encode($json));
    }

    public static function disconnect($room_slug, $type)
    {
        $id = BaresipWebrtc::room_baresip_id($room_slug, 'dec');
        $user_id = auth()->user()->id . '_' . $type;
        BaresipWebrtc::command($id, 'webrtc_disconnect', null, $user_id);
    }

    public static function update_audio($room_id, User $user)
    {
        if ($user->is_speaker($room_id))
            BaresipWebrtc::command($room_id, 'aumix_mute', 'false', $user->id . '_audio');
        else
            BaresipWebrtc::command($room_id, 'aumix_mute', 'true', $user->id . '_audio');
    }

    public static function sdp($room_slug, $params, $video = false, $cam = false)
    {
        $type = 'audio';

        if ($video)
            $type = 'video';
        
        $_params = "true,$type," . $params;

        $id = BaresipWebrtc::room_baresip_id($room_slug, 'inc');
        if ($room_slug !== 'echo') {
            $room = Room::whereSlug($room_slug)->firstOrFail();
            if (auth()->user()->is_speaker($room->id)) {
                $_params = "false,$type," . $params;
            }
            if ($video && !$cam && !$room->video_available())
                abort(404);
        }

        BaresipWebrtc::command($id, 'webrtc_sdp', $_params);
    }

    public static function sdp_answer($baresip_id, $json)
    {
        $param = explode(',', $json->param, 5);
        $sess_id = $param[2];
        $user_id = explode('_', $sess_id, 2)[0];
        $type = $param[3];
        $sdp = json_decode($param[4]);
        if ($type === 'video')
            WebrtcSDPVideo::dispatch($user_id, $sdp);
        if ($type === 'audio')
            WebrtcSDP::dispatch($user_id, $sdp);
    }

    public static function talk_event($baresip_id, $json)
    {
        $param = explode(',', $json->param, 5);
        $sess_id = $param[2];
        $user_id = explode('_', $sess_id, 2)[0];
        WebrtcTalk::dispatch($baresip_id, $user_id);
    }

    public static function mqtt_event($topic, $message)
    {
        $json = json_decode($message);
        if (empty($json->param))
            return;

        $baresip_id = explode('/', $topic, 4)[2];

        $param = explode(',', $json->param, 3);
        $module = $param[0];
        $event = $param[1];

        if ($module == "webrtc" && $event == "sdp")
            BaresipWebrtc::sdp_answer($baresip_id, $json);

        if ($module == "aumix" && $event == "talk")
            BaresipWebrtc::talk_event($baresip_id, $json);

        $json = null;
    }

    public static function listen()
    {
        $mqtt = MQTT::connection();

        pcntl_signal(SIGINT, function () use ($mqtt) {
            Log::info('Received SIGINT signal, interrupting the client for a graceful shutdown...');

            $mqtt->interrupt();
        });

        $mqtt->subscribe('/baresip/+/event', function (string $topic, string $message) {
            // Log::info("Received QoS level 0 message on topic [$topic]: $message");

            BaresipWebrtc::mqtt_event($topic, $message);
            $topic = null;
            $message = null;
        }, 0);
        $mqtt->loop(true);
        $mqtt->disconnect();
    }
}
