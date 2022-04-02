<?php

use PhpMqtt\Client\Facades\MQTT;

function ceshi()
{
    $res = PhpMqtt\Client\Facades\MQTT::publish('testtopic',"11");
    
}