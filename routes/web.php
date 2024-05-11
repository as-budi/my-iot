<?php

use App\Models\Device;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\DeviceController;

Route::get('/', function () {
    return view('dashboard', [
        "title" => "dashboard"
    ]);
});

Route::get('/dashboard', function(){
    return view('dashboard', [
        "title" => "dashboard"
    ]);
});

Route::get('/devices', [DeviceController::class, 'web_index']);
Route::get('/devices/{id}', [DataController::class, 'web_show']);

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

Route::post( '/publish', [DataController::class, 'publish'] )->name('publish');