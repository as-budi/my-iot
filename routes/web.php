<?php

use App\Http\Controllers\DeviceController;
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

Route::get('/devices', [DeviceController::class, 'index']);
Route::get('/devices/{id}', [DeviceController::class, 'show']);

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