<?php

use PhpMqtt\Client\Facades\MQTT;
use Illuminate\Support\Facades\Route;




function mqtt()
{
$mqtt = MQTT::connection();
$mqtt->subscribe('qing', function (string $topic, string $message) {
    return $message;
}, 1);
$mqtt->loop(true);
}
