<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/', function () {
    return redirect('/admin/login');
});

Route::get('/admin', function () {
    return  redirect('/admin/login');
});

Route::get('/teacher', function () {
    return redirect('/teacher/login');
});



// Password reset and other admin-specific routes
Route::prefix('admin')->middleware(['auth:web'])->group(function () {
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
    })->name('filament.teacher.resources.teachers.profile');

});
// Routes specific to deans
Route::prefix('dean')->middleware(['auth:dean'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dean.dashboard');  // Assuming you have a dashboard view for deans
    })->name('dean.dashboard');
});
