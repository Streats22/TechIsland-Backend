<?php

use App\Http\Controllers\CodenamesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/', function () {
    return redirect('admin/login');
});
Route::post('/assign-codenames', [CodenamesController::class, 'assignCodenames'])->name('assign-codenames');
Route::post('/clear-codenames', [CodenamesController::class, 'clearCodenames'])->name('clear-codenames');

// Password reset and other admin-specific routes
Route::prefix('admin')->group(function () {
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('filament.password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('filament.password.update');
    Route::get('password/request', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('filament.password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('filament.password.email');
});


Route::prefix('teacher')->middleware(['auth:teacher'])->group(function () {
    Route::get('/dashboard', function () {
        return view('teacher.dashboard');  // Assuming you have a dashboard view for teachers
    })->name('teacher.dashboard');

    Route::get('/personal-profile', function () {
        logger('Personal profile route hit.');
        return app(\App\Filament\Resources\TeachersResource\Pages\PersonalProfile::class)->render();
    })->name('teacher.personal-profile');

});
// Routes specific to deans
Route::prefix('dean')->middleware(['auth:dean'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dean.dashboard');  // Assuming you have a dashboard view for deans
    })->name('dean.dashboard');
});

