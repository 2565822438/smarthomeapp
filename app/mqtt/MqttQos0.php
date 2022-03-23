<?php

namespace App\mqtt;
use phpmqtt\Client\Facades\MQTT;



// Create an instance of a PSR-3 compliant logger. For this example, we will also use the logger to log exceptions.
class MqttQos0{
    public function sub() {                                         
        MQTT::publish('smarthome/sub','hello');
    }


    public function pub() {           //收到
        $mqtt = MQTT::connection();
        $mqtt -> subscribe('some/topic',function(string $topic,string $message)
        {
            echo sprintf('Received QoS level 1 message on topic [%s]: %s', $topic, $message);
        },1);
        $mqtt->loop(true);
    }
}

