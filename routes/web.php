<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/new', 'App\Http\Controllers\TestController@controllerMethod');

Route::any('{slug}', function() {
    return view('welcome');
});