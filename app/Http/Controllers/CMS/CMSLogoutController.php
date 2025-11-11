<?php

namespace App\Http\Controllers\CMS;

use App\Services\AuthService;
use Illuminate\Http\Request;

class CMSLogoutController
{
    public function logout(Request $request)
    {
        $redirectRoute = AuthService::logout($request);
        return redirect()->to($redirectRoute);
    }
}
