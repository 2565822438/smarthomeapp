<?php

namespace App\Service;

use Illuminate\Support\Facades\Auth;
use Salman\Mqtt\MqttClass\Mqtt;



// Create an instance of a PSR-3 compliant logger. For this example, we will also use the logger to log exceptions.
class MqttService{
    public static function SendMsgViaMqtt($topic, $message)
    {
        $mqtt = new Mqtt();
        $client_id = Auth::user()->id ?? 0;
        $output = $mqtt->ConnectAndPublish($topic, $message, $client_id);

        if ($output === true)
        {
            return "published";
        }

        return "Failed";
    }

    public function SubscribetoTopic($topic)
    {
        $mqtt = new Mqtt();
        $client_id = Auth::user()->id;
        $mqtt->ConnectAndSubscribe($topic, function($topic, $msg){
            echo "Msg Received: \n";
            echo "Topic: {$topic}\n\n";
            echo "\t$msg\n\n";
        }, $client_id);


    }
}

