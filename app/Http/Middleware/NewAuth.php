<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class NewAuth extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string[] ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        echo('NewAuth middleware handle method invoked.');

        $nonAuthRoutes = [
            route('filament.password.request'),
            route('filament.password.reset', ['token' => 'placeholder']),
            route('filament.password.email'),
            route('filament.password.update'),
        ];

        foreach ($nonAuthRoutes as $route) {
            if ($request->fullUrlIs($route) || $request->is($route)) {
                echo("Request is for non-auth route: {$route}, bypassing authentication check.");
                return $next($request);
            }
        }

        $loginUrl = $this->redirectTo($request);
        if ($request->url() === $loginUrl) {
            echo('Request is for login URL, bypassing authentication check.');
            return $next($request);
        }

        $guards = ['web', 'dean', 'teacher', 'student'];
        foreach ($guards as $guard) {
            if ($this->attemptAuthenticate($request, $guard)) {
                return $next($request);
            }
        }

        return $this->unauthenticated($request, $guards);
    }

    protected function attemptAuthenticate($request, $guard): bool
    {
        echo("Attempting to authenticate with guard: {$guard}");
        $this->auth->shouldUse($guard);

        $guardInstance = Auth::guard($guard);
        if ($guardInstance->check()) {
            $user = $guardInstance->user();
//            echo("User found with guard {$guard}: " ['user' => $user]);

            $panel = Filament::getCurrentPanel();

            if ($user instanceof FilamentUser && $user->canAccessPanel($panel)) {
                Filament::auth()->setUser($user);
                echo("User authenticated with guard {$guard} and has access to the panel.");
                return true;
            } else {
                echo("User authenticated with guard {$guard} but does not have access to the panel.");
                Auth::guard($guard)->logout();
            }
        } else {
            echo("Guard instance check failed for guard {$guard}");
        }

        echo("Authentication attempt failed for guard {$guard}.");
        return false;
    }


    protected function unauthenticated($request, array $guards)
    {
        echo('Handling unauthenticated request. Redirecting to login.');

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Unauthenticated.'], 403);
        } else {
            $loginUrl = $this->redirectTo($request);
            return redirect()->guest($loginUrl);
        }
    }

    protected function redirectTo($request): ?string
    {
        return Filament::getLoginUrl();
    }

}
