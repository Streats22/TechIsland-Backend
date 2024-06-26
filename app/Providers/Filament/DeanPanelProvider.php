<?php

namespace App\Providers\Filament;
use App\Filament\Resources\StudentsResource;
use App\Filament\Resources\StudentsResource\Pages\ListStudents;
use App\Filament\Resources\TeacherResource\Pages\PersonalProfile;
//use App\Filament\Resources\TeachersResource\Pages\PersonalProfile;
use App\Filament\Resources\TeachersResource;
use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use App\Filament\Resources\DeansResource;
use App\Http\Controllers\Auth\ForgotPasswordController;

use App\Http\Middleware\DeanAuthMiddleware;
use App\Http\Middleware\TeacherAuthMiddleware;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Swis\Filament\Backgrounds\FilamentBackgroundsPlugin;
use Swis\Filament\Backgrounds\ImageProviders\MyImages;

class DeanPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('dean')
            ->path('dean')
            ->authGuard('dean')// Define a unique path for the teacher panel
            ->login()
            ->colors([
                'primary' => Color::Slate,
                'secondary' => Color::Sky,
            ])
            ->pages([
                Pages\Dashboard::class
            ])
            ->resources([
                DeansResource::class,
                TeachersResource::class
            ])
            ->widgets([
                Widgets\AccountWidget::class,  // Example widget, you can define or remove widgets as needed
            ])
            ->plugins([
                FilamentBackgroundsPlugin::make()
                    ->imageProvider(
                        MyImages::make()
                            ->directory('images/backgrounds')
                    ),
            ])
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([  DeanAuthMiddleware::class,])
            ->passwordReset(
                [ForgotPasswordController::class, 'showLinkRequestForm']
            );
    }

    protected function getRoutes(): void
    {
        Route::get('/password/request', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('dean.password.request');
        Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('dean.password.email');
    }
}
