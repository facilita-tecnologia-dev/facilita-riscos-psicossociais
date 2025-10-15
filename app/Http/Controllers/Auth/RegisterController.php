<?php

namespace App\Http\Controllers\Auth;

use App\Enums\BaseCollection;
use App\Enums\PROART\PROARTHazard;
use App\Http\Requests\RegisterCompanyRequest;
use App\Models\BaseControlAction;
use App\Models\Company;
use App\Models\CompanyReport;
use App\Models\Metric;
use App\Models\PROARTIndicator;
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
                'psychosocial_collection_type' => BaseCollection::HSE->value,
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
            PROARTIndicator::each(fn($metric) => $company->proartIndicators()->create(['indicator_id' => $metric->id]));
        });
    }
    
    private function createReports(Company $company)
    {
        DB::transaction(function() use($company) {
            CompanyReport::insert([
                ['company_id' => $company->id, 'type' => PROARTHazard::MORAL_HARASSMENT->value],
                ['company_id' => $company->id, 'type' => PROARTHazard::SEXUAL_HARASSMENT->value],
                ['company_id' => $company->id, 'type' => PROARTHazard::DISCRIMINATION->value],
                ['company_id' => $company->id, 'type' => PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value],
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
                    'hazard_id' => $controlAction->hazard_id,
                    'control_action_type_id' => $controlAction->control_action_type_id,
                    'gravity' => $controlAction->gravity,
                    'content' => $controlAction->content,
                ])
            );
        });
    }
}
