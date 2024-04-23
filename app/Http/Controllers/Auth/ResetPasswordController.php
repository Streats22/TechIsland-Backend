<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Deans;
use App\Models\Teachers;
use App\Models\User;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with([
            'token' => $token,
            'email' => $request->input('email')
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $userType = $this->getUserType($request->email);
        $guard = $this->getGuard($userType);

        $status = Password::broker($userType)->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($guard) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new \Illuminate\Auth\Events\PasswordReset($user));

                Auth::guard($guard)->login($user);
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->intended("admin/")->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    private function getUserType($email)
    {
        if (Deans::where('email', $email)->exists()) {
            return 'deans';
        } elseif (Teachers::where('email', $email)->exists()) {
            return 'teachers';

        }
        return 'users'; // Default to users
    }

    private function getGuard($userType)
    {
        return match ($userType) {
            'deans' => 'dean',
            'teachers' => 'teacher',
//            'students' => 'student',
            default => 'web',
        };
    }
}
