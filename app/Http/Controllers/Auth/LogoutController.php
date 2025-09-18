<?php

namespace App\Http\Controllers\Auth;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController
{
    public function logout(Request $request)
    {
        $redirectRoute = AuthService::logout($request);
        return redirect()->to($redirectRoute);
    }
}
