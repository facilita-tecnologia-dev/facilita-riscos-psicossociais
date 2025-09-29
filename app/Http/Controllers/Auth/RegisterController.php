<?php

namespace App\Http\Controllers\Auth;

use App\Enums\RiskTypes;
use App\Http\Requests\RegisterCompanyRequest;
use App\Models\BaseControlAction;
use App\Models\Company;
use App\Models\CompanyReport;
use App\Models\Metric;
use App\Services\AuthService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController
{
    public function showRegister()
    {
        return view('auth.register.company');
    }

    public function register(RegisterCompanyRequest $request)
    {
        DB::transaction(function () use ($request) {
            $company = Company::create([
                'name' => $request->validated('name'),
                'cnpj' => $request->validated('cnpj'),
                'email' => $request->validated('email'),
                'password' => Hash::make($request->validated('password')),
            ]);

            $this->createMetrics($company);
            $this->createReports($company);
            $this->createActionPlan($company);
            
            AuthService::authenticate('company', $company);

            AuthService::putGuardOnSession('company');
            AuthService::putCompanyOnSession($company);
        });

        return redirect()->to(AuthService::redirectLoginRoute('company'));
    }

    private function createMetrics(Company $company)
    {
        DB::transaction(function() use($company) {
            Metric::each(fn($metric) => $company->metrics()->create(['metric_id' => $metric->id]));
        });
    }
    
    private function createReports(Company $company)
    {
        DB::transaction(function() use($company) {
            CompanyReport::insert([
                ['company_id' => $company->id, 'type' => RiskTypes::MORAL_HARASSMENT->value],
                ['company_id' => $company->id, 'type' => RiskTypes::SEXUAL_HARASSMENT->value],
                ['company_id' => $company->id, 'type' => RiskTypes::DISCRIMINATION->value],
                ['company_id' => $company->id, 'type' => RiskTypes::OTHER_FORMS_OF_VIOLENCE->value],
            ]);
        });
    }

    private function createActionPlan(Company $company)
    {
        DB::transaction(function() use($company) {
            $actionPlan = $company->actionPlan()->create();

            BaseControlAction::all()->each(fn($controlAction) => 
                $actionPlan->controlActions()->create([
                    'action_plan_id' => $actionPlan->id,
                    'risk_id' => $controlAction->risk_id,
                    'control_action_type_id' => $controlAction->control_action_type_id,
                    'gravity' => $controlAction->gravity,
                    'content' => $controlAction->content,
                ])
            );
        });
    }
}
