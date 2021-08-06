<?php

namespace App\Models;

use App\Events\WebrtcSDP;
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
        else
            $room->baresip?->dec_users();
        return $room->baresip?->id;
    }

    public static function command($id, $cmd, $arg = NULL)
    {
        $params = "";
        if (!empty($arg))
            $params = "," . $arg;

        $user_id = auth()->user()->id;

        $json = [
            'command' => "webrtc_$cmd",
            'params' => $user_id . $params,
            'token' => strval(auth()->user()->id)
        ];
        MQTT::publish("/baresip/$id/command/", json_encode($json));
    }

    public static function disconnect($room_slug)
    {
        $id = BaresipWebrtc::room_baresip_id($room_slug, 'dec');
        BaresipWebrtc::command($id, 'disconnect');
    }

    public static function sdp($room_slug, $params)
    {
        $id = BaresipWebrtc::room_baresip_id($room_slug, 'inc');
        BaresipWebrtc::command($id, 'sdp', $params);
    }

    public static function sdp_answer($message)
    {
        $json = json_decode($message);
        if (empty($json->param))
            return;
        $param = explode(',', $json->param, 4);
        $user_id = $param[2];
        $sdp = json_decode($param[3]);
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
