<?php

namespace App\Http\Controllers;
use App\Models\Data;
use App\Models\Device;
use Illuminate\Http\Request;

use \PhpMqtt\Client\MqttClient;
use \PhpMqtt\Client\ConnectionSettings;

class DataController extends Controller
{
    public function index()
    {
        return Data::all();
    }

    public function store(Request $request)
    {
        $data = new Data;
        $data->device_id = $request->device_id;
        $data->data = $request->data;
        $data->save();

        if (Device::where('id', $request->device_id)->exists()) {
            $device = Device::find($request->device_id);
            $device->current_value = $request->data;
            $device->save();
        }

        return response()->json([
            "message" => "data has been added."
        ], 201);

    }

    public function show($id)
    {
        return Data::where('device_id', $id)->get();
    }

    public function web_show($id){
        return view('device', [
            "title" => "device",
            "device" => Device::find($id),
            "data" => Data::where('device_id',$id)->orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function pub(Request $request){
        $pub_topic = env('MQTT_TOPIC_PUB', 'emqx/test');
        $server   = env('MQTT_BROKER', 'broker.emqx.io');
        $port     = env('MQTT_PORT', 1883);
        $pub_clientId = env('MQTT_CLIENT_ID_PUB', 'my-pub-unique-id-1234567890');
        $username = env('MQTT_USER', '');
        $password = env('MQTT_PASSWORD', '');
        $clean_session = false;
        $mqtt_version = MqttClient::MQTT_3_1_1;

        $connectionSettings = (new ConnectionSettings)
        ->setUsername($username)
        ->setPassword($password)
        ->setKeepAliveInterval(60);

        $mqtt = new MqttClient($server, $port, $pub_clientId, $mqtt_version);
        $mqtt->connect($connectionSettings, $clean_session);
        printf("Publishser client connected!\n");


        $mqtt->publish($pub_topic, $request, 0, true);
        $mqtt->disconnect();
        return response()->json([
            "message" => "Data has been publish."
        ], 201);
    }

    public function publish(){
        $device_id = (int) request()->get('device_id');
        $data = (int) request()->get('data');
        $msg = json_encode([
            "device_id" => $device_id,
            "data" => $data
        ]);

        $pub_topic = env('MQTT_TOPIC_PUB', 'emqx/test');
        $server   = env('MQTT_BROKER', 'broker.emqx.io');
        $port     = env('MQTT_PORT', 1883);
        $pub_clientId = env('MQTT_CLIENT_ID_PUB', 'my-pub-unique-id-1234567890');
        $username = env('MQTT_USER', '');
        $password = env('MQTT_PASSWORD', '');
        $clean_session = false;
        $mqtt_version = MqttClient::MQTT_3_1_1;

        $connectionSettings = (new ConnectionSettings)
        ->setUsername($username)
        ->setPassword($password)
        ->setKeepAliveInterval(60);

        $mqtt = new MqttClient($server, $port, $pub_clientId, $mqtt_version);
        $mqtt->connect($connectionSettings, $clean_session);
        printf("Publishser client connected!\n");


        $mqtt->publish($pub_topic, $msg, 0, true);
        $mqtt->disconnect();

        $d = new Data;
        $d->device_id = $device_id;
        $d->data = $data;
        $d->save();

        if (Device::where('id', $device_id)->exists()) {
            $device = Device::find($device_id);
            $device->current_value = $data;
            $device->save();
        }

        return view('device', [
            "title" => "device",
            "device" => Device::find($device_id),
            "data" => Data::where('device_id',$device_id)->orderBy('created_at', 'DESC')->get()
        ]);
    }
}
