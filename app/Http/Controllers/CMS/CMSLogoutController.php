<?php

namespace App\Http\Controllers\Cms;

use App\Services\Auth\AuthenticationService;
use Illuminate\Http\Request;

class CmsLogoutController
{
    public function logout(Request $request)
    {
        $redirectRoute = AuthenticationService::logout($request);
        return redirect()->to($redirectRoute);
    }
}
