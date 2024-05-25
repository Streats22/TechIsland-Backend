<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/', function () {
    return view('welcome');
});

// Password reset routes for Filament
Route::prefix('admin')->group(function () {
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('filament.password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('filament.password.update');
    Route::get('password/request', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('filament.password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('filament.password.email');
});


// Ensure these routes are accessible after login
Route::group(['prefix' => 'filament', 'middleware' => ['auth.multiple:web,teacher,dean']], function () {
    Route::get('/personal-profile', [App\Filament\Resources\TeachersResource\Pages\MyProfile::class, 'render'])->name('filament.pages.my-profile');
});
