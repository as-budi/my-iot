<?php

namespace App\Console\Commands;
// require('vendor/autoload.php');

use App\Models\Data;
use App\Models\Device;

use \PhpMqtt\Client\MqttClient;
use Illuminate\Console\Command;
use \PhpMqtt\Client\ConnectionSettings;

class MqttListener extends Command
{
    protected $signature = 'app:mqtt-listener';
    protected $description = 'Command description';

    public function handle()
    {
        $sub_topic = env('MQTT_TOPIC_SUB', 'emqx/test');
        $server   = env('MQTT_BROKER', 'broker.emqx.io');
        $port     = env('MQTT_PORT', 1883);
        $sub_clientId = env('MQTT_CLIENT_ID_SUB', 'my-sub-unique-id-1234567890');
        $username = env('MQTT_USER', '');
        $password = env('MQTT_PASSWORD', '');
        $clean_session = false;
        $mqtt_version = MqttClient::MQTT_3_1_1;

        $connectionSettings = (new ConnectionSettings)
        ->setUsername($username)
        ->setPassword($password)
        ->setKeepAliveInterval(60);


        $mqtt = new MqttClient($server, $port, $sub_clientId, $mqtt_version);

        $mqtt->connect($connectionSettings, $clean_session);
        printf("Subscriber client connected!\n");

        $mqtt->subscribe($sub_topic, function ($topic, $message) {
            printf("Received message on topic [%s]: %s\n", $topic, $message);
            $objMsg = json_decode($message);
            printf("device_id: %d\n", $objMsg->device_id);
            printf("data: %d\n", $objMsg->data);
            $data = new Data;
            $data->device_id = $objMsg->device_id;
            $data->data = $objMsg->data;
            $data->save();

            if (Device::where('id', $objMsg->device_id)->exists()) {
                $device = Device::find($objMsg->device_id);
                $device->current_value = $objMsg->data;
                $device->save();
            }
            printf("Data has been saved to database\n");
        }, 0);
        
        // $payload = array(
        //     'protocol' => 'tcp',
        //     'date' => date('Y-m-d H:i:s'),
        //     'data' => 'Hello MQTT'
        // );
        
        // $mqtt->publish('emqx/test', json_encode($payload), 0, true);
        // printf("msg published\n");

        $mqtt->loop(true);
    }
}
