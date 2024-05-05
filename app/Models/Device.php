<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

class Device
{
    private static $devices = [
        [
            "id" => 1,
            "name" => "Sensor Suhu",
            "min_value" => 0,
            "max_value" => 100,
            "current_value" => 25
        ],
        [
            "id" => 2,
            "name" => "Kipas Angin",
            "min_value" => 0,
            "max_value" => 5,
            "current_value" => 2
        ],
        [
            "id" => 3,
            "name" => "Lampu Kamar",
            "min_value" => 0,
            "max_value" => 100,
            "current_value" => 50
        ],
        [
            "id" => 4,
            "name" => "Lampu Taman",
            "min_value" => 0,
            "max_value" => 1,
            "current_value" => 1
        ]
    ];

    public static function all(){
        return self::$devices;
    }

    public static function find($id){
        $devices = self::$devices;
        $select_device = [];
        foreach($devices as $device){
            if($device["id"] == $id){
                $select_device = $device;
            }
        };
        return $select_device;
    }
}
