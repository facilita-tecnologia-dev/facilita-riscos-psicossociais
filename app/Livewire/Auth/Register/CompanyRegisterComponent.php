<?php

namespace App\Livewire\Auth\Register;

use App\Enums\Campaign\MetodologyType;
use App\Enums\Psychosocial\PROART\PROARTHazard;
use App\Models\BaseControlAction;
use App\Models\Company;
use App\Models\CompanyReport;
use App\Models\PROARTIndicator;
use App\Services\Auth\AuthenticationService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class CompanyRegisterComponent extends Component
{
    public ?string $name = null;
    public ?string $cnpj = null;
    public ?string $email = null;
    public ?string $password = null;
    public ?string $password_confirmation = null;

    public function render()
    {
        return view('livewire.auth.register.company-register-component');
    }

    public function submit()
    {
        $this->validate([
            'name' => ['required', 'string', 'min:6', 'max:255'],
            'cnpj' => ['required', 'string', 'unique:companies', 'cnpj'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'max:100', Password::defaults()],
            'password_confirmation' => ['required', 'string', 'same:password', 'max:100'],
        ]);

        try {
            DB::transaction(function() {
                $company = Company::create([
                    'name' => $this->name,
                    'cnpj' => $this->cnpj,
                    'email' => $this->email,
                    'password' => Hash::make($this->password),
                    'psychosocial_collection_type' => MetodologyType::HSE->value,
                ]);

                $this->createMetrics($company);
                $this->createReports($company);
                $this->createActionPlan($company);
                
                AuthenticationService::authenticate('company', $company);

                AuthenticationService::putGuardOnSession('company');
                AuthenticationService::putCompanyOnSession($company);
            });

            $this->dispatch('alert:success', "Cadastro realizado com sucesso!");

            return redirect()->to(AuthenticationService::redirectLoginRoute('company'));
        } catch (\Throwable $th) {
            report($th);
            $this->dispatch('alert:danger', "Ocorreu um erro ao realizar o cadastro.");
        }
    }

    private function createMetrics(Company $company)
    {
        PROARTIndicator::each(fn($metric) => $company->proartIndicators()->create(['indicator_id' => $metric->id]));
    }
    
    private function createReports(Company $company)
    {
        CompanyReport::insert([
            ['company_id' => $company->id, 'type' => PROARTHazard::MORAL_HARASSMENT->value],
            ['company_id' => $company->id, 'type' => PROARTHazard::SEXUAL_HARASSMENT->value],
            ['company_id' => $company->id, 'type' => PROARTHazard::DISCRIMINATION->value],
            ['company_id' => $company->id, 'type' => PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value],
        ]);
    }

    private function createActionPlan(Company $company)
    {
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
    }
}
