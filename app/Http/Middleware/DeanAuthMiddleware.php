<?php

namespace App\Http\Middleware;

use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DeanAuthMiddleware extends Middleware
{
    /**
     * Handle an incoming request to authenticate with the 'teacher' guard.
     *
     * @param \Illuminate\Http\Request $request
     * @param array<string> $guards
     * @return void
     * @throws AuthenticationException
     */
    protected function authenticate($request, array $guards): void
    {
        $guards = ['dean'];

        if (Auth::guard('dean')->check()) {
            Auth::shouldUse('dean');  // Use the 'teacher' guard explicitly
            $user = Auth::guard('dean')->user();

            $panel = Filament::getCurrentPanel();
            if ($user instanceof FilamentUser && $user->canAccessPanel($panel)) {
                return;  // Authenticated and can access the panel
            }
        }

        // If authentication fails
        $this->unauthenticated($request, $guards);
    }

    /**
     * Redirect to the teacher login page if unauthenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @param array<string> $guards
     * @return string|null
     * @throws AuthenticationException
     */
    protected function unauthenticated($request, array $guards): ?string
    {
        throw new AuthenticationException(
            'Unauthenticated.',
            $guards,
            Filament::getLoginUrl()  // Ensure you have this route defined
        );
    }

    protected function redirectTo($request): ?string
    {
        return Filament::getLoginUrl(); // Ensure you have this route defined
    }
}
