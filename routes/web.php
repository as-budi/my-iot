<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function(){
    return view('dashboard', [
        "title" => "dashboard"
    ]);
});

Route::get('/devices', function(){
    $devices = [
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
    return view('devices', [
        "title" => "devices",
        "devices" => $devices 
    ]);
});

Route::get('/devices/{id}', function($id){
    $devices = [
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

    $select_device = [];
    foreach($devices as $device){
        if($device["id"] == $id){
            $select_device = $device;
        }
    };

    return view('device', [
        "title" => "device",
        "device" => $select_device
    ]);
});

Route::get('/rules', function(){
    return view('rules', [
        "title" => "rules"
    ]);
});

Route::get('/users', function(){
    return view('users', [
        "title" => "users"
    ]);
});