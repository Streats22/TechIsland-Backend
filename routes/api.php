<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/leerling/{id}', [\App\Http\Controllers\UserDataController::class, 'show']);

Route::get('/workshops', [\App\Http\Controllers\UserDataController::class, 'workshops']);

Route::post('/leerling/create', [\App\Http\Controllers\StudentController::class, 'create']);
//Route::post('/leerling/update', [\App\Http\Controllers\StudentController::class, 'update']);
