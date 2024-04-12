<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => 'redirect.if.not.installed'], function () {
    Route::get('/', function () {
        return view('welcome');
    });
});
