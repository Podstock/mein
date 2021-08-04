<?php

namespace App\Models;

use App\Events\WebrtcSDP;
use Illuminate\Support\Facades\Log;
use PhpMqtt\Client\Facades\MQTT;

class BaresipWebrtc
{
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

    public static function disconnect($id)
    {
        if (empty($id))
            return;
        BaresipWebrtc::command($id, 'disconnect');
    }

    public static function sdp($id, $params)
    {
        if (empty($id))
            return;
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
