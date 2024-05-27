<?php

namespace App\Http\Middleware;

use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Attempt to authenticate using guards.
     *
     * @param \Illuminate\Http\Request $request
     * @param array<string> $guards
     * @return void
     * @throws AuthenticationException
     */
    protected function authenticate($request, array $guards): void
    {
        $guard = $this->determineGuard($request, $guards);

        // This loop ensures that we check each guard until one is authenticated.
        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                $this->auth->shouldUse($guard);

                /** @var Model $user */
                $user = $this->auth->guard($guard)->user();

                $panel = Filament::getCurrentPanel();

                // Check if the authenticated user can access the specific Filament panel.
                abort_if(
                    $user instanceof FilamentUser && !$user->canAccessPanel($panel),
                    403,
                    'Access Denied: You do not have permission to access this panel.'
                );

                return;  // Exit if authenticated successfully
            }
        }

        // If no guard authenticated, handle unauthenticated state.
        $this->unauthenticated($request, $guards);
    }

    /**
     * Determine which guard to use based on the request or other logic.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return string
     */
    protected function determineGuard($request, array $guards)
    {
        // Example: choose guard based on the route or path
        if ($request->is('teacher-panel/*')) {
            return 'teacher';
        } elseif ($request->is('dean-panel/*')) {
            return 'dean';
        } elseif ($request->is('student-panel/*')) {
            return 'student';
        }

        // Default to first specified guard or fallback to default
        return $guards[0] ?? 'web'; // Adjust the default guard as needed
    }

    /**
     * Redirect to the login route if unauthenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request): ?string
    {
        return Filament::getLoginUrl();
    }
}
