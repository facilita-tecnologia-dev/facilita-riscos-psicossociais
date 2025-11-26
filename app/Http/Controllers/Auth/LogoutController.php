<?php

namespace App\Http\Controllers\Auth;

use App\Services\AuthenticationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController
{
    public function logout(Request $request)
    {
        $redirectRoute = AuthenticationService::logout($request);
        return redirect()->to($redirectRoute);
    }
}
