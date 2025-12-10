<?php

namespace App\Http\Controllers\Private\Company;

use App\Models\Company;
use App\Services\Auth\AuthenticationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CompanyController
{
    public function register()
    {
        return view('auth.register.company.index');
    }

    public function login()
    {
        return view('auth.login.company.index');
    }

    public function home()
    {
        return view('private.home.company.index');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password.company.index');
    }

    public function resetPassword(Request $request, string $token)
    {
        return view('auth.reset-password.company.index', [
            'token' => $token,
            'email' => request('email')
        ]);
    }

    public function show(Company $company)
    {
        Gate::forUser(AuthenticationService::user())->authorize('show', [Company::class, $company]);
        return view('private.company.show.index', compact('company'));
    }
}
