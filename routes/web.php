<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
//use App\Http\Controllers\Auth\ForgotPasswordController;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->group(function () {

    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('filament.password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('filament.password.update');
    Route::get('password/request', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('filament.password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('filament.password.email');

});
