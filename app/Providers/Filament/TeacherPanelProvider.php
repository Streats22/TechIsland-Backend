<?php

namespace App\Providers\Filament;

use App\Filament\Resources\StudentsResource;
use App\Filament\Resources\StudentsResource\Pages\ListStudents;
//use App\Filament\Resources\TeacherResource\Pages\PersonalProfile;
//use App\Filament\Resources\TeachersResource\Pages\PersonalProfile;
use App\Filament\Resources\TeachersResource;
use App\Http\Controllers\Auth\ForgotPasswordController;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Swis\Filament\Backgrounds\FilamentBackgroundsPlugin;
use Swis\Filament\Backgrounds\ImageProviders\MyImages;
use Illuminate\Support\Facades\Auth;

class TeacherPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('teacher')
            ->path('teacher')
            ->authGuard('teacher')
            ->login()
            ->colors([
                'primary' => Color::Slate,
                'secondary' => Color::Sky,
            ])
            ->resources([
                StudentsResource::class,
                TeachersResource::class
            ])
            ->pages($this->getPages())
            ->widgets($this->getWidgets())
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
            ->authMiddleware([  TeacherAuthMiddleware::class,])
            ->passwordReset(
                [ForgotPasswordController::class, 'showLinkRequestForm']
            );
    }

    protected function getRoutes(): void
    {
        Route::get('/password/request', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('teacher.password.request');
        Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('teacher.password.email');
    }

    protected function getPages(): array
    {
        $pages = [
            Pages\Dashboard::class, // Accessible to all authenticated teachers
        ];


        return $pages;
    }

    protected function getWidgets(): array
    {
        $widgets = [
            Widgets\AccountWidget::class,  // Example widget, accessible to all authenticated teachers
        ];

        // Add conditional widgets based on permissions
        if (auth()->check() && auth()->teacher()) {
            $widgets[] = Widgets\AdminWidget::class; // Example of an admin-only widget
        }

        return $widgets;
    }

}
