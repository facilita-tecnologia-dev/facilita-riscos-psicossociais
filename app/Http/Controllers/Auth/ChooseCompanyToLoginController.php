<?php

namespace App\Http\Controllers\Auth;

use App\Models\BaseCollection;
use App\Models\Collection;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Support\Facades\Auth;

class ChooseCompanyToLoginController
{
    public function __invoke()
    {
        $userCompanies = Auth::user()->companies;

        return view('auth.login.user.choose-company', compact('userCompanies'));
    }

    public function attemptInternalLoginWithCompany(Company $company)
    {
        session(['company' => $company]);

        if (Auth::user()->hasRole('manager')) {
            return redirect()->route('dashboard.psychosocial');
        }

        return redirect()->route('answer-test', BaseCollection::where('key_name', 'psychosocial-risks')->first());
    }
}
