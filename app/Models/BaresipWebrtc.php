<?php

namespace App\Models;

use App\Events\WebrtcSDP;
use App\Events\WebrtcSDPVideo;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use PhpMqtt\Client\Facades\MQTT;

class BaresipWebrtc
{
    protected static function room_baresip_id($room_slug, $operator)
    {
        if ($room_slug === 'echo')
            return 'echo';

        $room = Room::whereSlug($room_slug)->firstOrFail();
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

    public static function disconnect($room_slug)
    {
        $id = BaresipWebrtc::room_baresip_id($room_slug, 'dec');
        BaresipWebrtc::command($id, 'webrtc_disconnect');
    }

    public static function update_audio($room_id, User $user)
    {
        if ($user->is_speaker($room_id))
            BaresipWebrtc::command($room_id, 'aumix_mute', 'false', $user->id);
        else
            BaresipWebrtc::command($room_id, 'aumix_mute', 'true', $user->id);
    }

    public static function sdp($room_slug, $params, $video = false)
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
        }

        BaresipWebrtc::command($id, 'webrtc_sdp', $_params);
    }

    public static function sdp_answer($message)
    {
        $json = json_decode($message);
        if (empty($json->param))
            return;

        $param = explode(',', $json->param, 5);
        $user_id = $param[2];
        $type = $param[3];
        $sdp = json_decode($param[4]);
        if ($type === 'video')
            WebrtcSDPVideo::dispatch($user_id, $sdp);
        if ($type === 'audio')
            WebrtcSDP::dispatch($user_id, $sdp);
    }

    public static function listen()
    {
        $mqtt = MQTT::connection();

        pcntl_signal(SIGINT, function () use ($mqtt) {
            Log::info('Received SIGINT signal, interrupting the client for a graceful shutdown...');

            $mqtt->interrupt();
        });

        $mqtt->subscribe('/baresip/+/event', function (string $topic, string $message) {
            Log::info("Received QoS level 0 message on topic [$topic]: $message");
            BaresipWebrtc::sdp_answer($message);
        }, 0);
        $mqtt->loop(true);
        $mqtt->disconnect();
    }
}
