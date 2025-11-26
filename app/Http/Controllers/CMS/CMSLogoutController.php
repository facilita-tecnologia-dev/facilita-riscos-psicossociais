<?php

namespace App\Http\Controllers\CMS;

use App\Services\AuthenticationService;
use Illuminate\Http\Request;

class CMSLogoutController
{
    public function logout(Request $request)
    {
        $redirectRoute = AuthenticationService::logout($request);
        return redirect()->to($redirectRoute);
    }
}
