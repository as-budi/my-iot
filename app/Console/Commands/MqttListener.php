<?php

namespace App\Console\Commands;
// require('vendor/autoload.php');

use \PhpMqtt\Client\MqttClient;
use \PhpMqtt\Client\ConnectionSettings;

use Illuminate\Console\Command;

class MqttListener extends Command
{
    protected $signature = 'app:mqtt-listener';
    protected $description = 'Command description';

    public function handle()
    {
        $server   = 'broker.emqx.io';
        $port     = 1883;
        $clientId = 'my-random-id-fqosjfdanlkql425q25243';
        $username = 'emqx_user';
        $password = 'public';
        $clean_session = false;
        $mqtt_version = MqttClient::MQTT_3_1_1;

        $connectionSettings = (new ConnectionSettings)
        ->setUsername($username)
        ->setPassword($password)
        ->setKeepAliveInterval(60)
        ->setLastWillTopic('emqx/test/last-will')
        ->setLastWillMessage('client disconnect')
        ->setLastWillQualityOfService(1);


        $mqtt = new MqttClient($server, $port, $clientId, $mqtt_version);

        $mqtt->connect($connectionSettings, $clean_session);
        printf("client connected\n");

        $mqtt->subscribe('emqx/test', function ($topic, $message) {
            printf("Received message on topic [%s]: %s\n", $topic, $message);
        }, 0);
        
        $payload = array(
            'protocol' => 'tcp',
            'date' => date('Y-m-d H:i:s'),
            'data' => 'Hello MQTT'
        );
        
        $mqtt->publish('emqx/test', json_encode($payload), 0, true);
        printf("msg published\n");

        $mqtt->loop(true);
    }
}
