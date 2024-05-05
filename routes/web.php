<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function(){
    return view('dashboard');
});

Route::get('/devices', function(){
    return view('devices');
});

Route::get('/rules', function(){
    return view('rules');
});

Route::get('/users', function(){
    return view('users');
});