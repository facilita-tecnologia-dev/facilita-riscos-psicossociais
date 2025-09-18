<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password as FacadesPassword;
use Illuminate\Validation\Rules\Password;

class ResetUserPasswordController
{

    public function forgot()
    {
        return view('auth.login.user.forgot-password');
    }

    public function send(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = FacadesPassword::broker('users')->sendResetLink(
            $request->only('email'),
            function ($user, $token) {
                $user->sendPasswordResetNotification($token, 'user');
            }
        );

        return $status === FacadesPassword::ResetLinkSent
        ? back()->with(['message' => __($status)])
        : back()->withErrors(['email' => __($status)]);
    }

    public function showReset(Request $request, string $token)
    {
        return view('auth.login.user.reset-password', [
            'token' => $token,
            'email' => request('email')
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ]);
        
        $status = FacadesPassword::broker('users')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );

        return $status === FacadesPassword::PasswordReset
        ? to_route('user.login')->with('message', __($status))
        : back()->withErrors(['password' => [__($status)]]);
    }
}
