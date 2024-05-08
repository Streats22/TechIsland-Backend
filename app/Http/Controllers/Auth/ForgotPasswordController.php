<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Deans;
use App\Models\Students;
use App\Models\Teachers;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        // Display the form for requesting a password reset link
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $userType = $this->getUserType($request->email);
        // Send the reset link using the appropriate broker based on the user type
        $response = Password::broker($userType)->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? back()->with('status', trans($response))
            : back()->withErrors(['email' => trans($response)]);
    }

    private function getUserType($email)
    {
        if (Deans::where('email', $email)->exists()) {
            return 'deans';
        } elseif (Teachers::where('email', $email)->exists()) {
            return 'teachers';
        }
        elseif (Students::where('email', $email)->exists()) {
            return 'students';
        }
        return 'users'; // Default to users
    }
}
