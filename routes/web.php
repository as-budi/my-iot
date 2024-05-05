<?php

use App\Models\Device;
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
    return view('devices', [
        "title" => "devices",
        "devices" => Device::all() 
    ]);
});

Route::get('/devices/{id}', function($id){
    return view('device', [
        "title" => "device",
        "device" => Device::find($id)
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