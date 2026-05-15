<?php

namespace App\Livewire\Auth\Register;

// use App\Actions\Subscription\CreateSubscriptionAction;
use App\Enums\Campaign\MetodologyType;
use App\Enums\Psychosocial\PROART\PROARTHazard;
// use App\Enums\Subscription\PaymentType;
use App\Models\BaseControlAction;
use App\Models\Company;
use App\Models\CompanyReport;
use App\Models\Organizationalndicator;
use App\Services\Auth\AuthenticationService;
// use App\Services\Subscription\SubscriptionPricingService;
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

    // public int $employees;
    // public int $amount;

    // public string $employeeRange;
    // public string $formattedAmount;

    // public PaymentType $paymentType;

    // public function mount()
    // {
    //     $subscriptionData = session('subscription_data');

    //     if (!$subscriptionData) {return redirect()->route('site.home');}

    //     $this->employees = $subscriptionData['employees'];
    //     $this->amount = $subscriptionData['amount'];

    //     $this->employeeRange = SubscriptionPricingService::employeeRange($subscriptionData['employees']);
    //     $this->formattedAmount = number_format($subscriptionData['amount'] / 100, 2, ',', '.');
    //     $this->paymentType = PaymentType::from($subscriptionData['payment_type']);
    // }

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
                    'has_cids' => true,
                ]);

                // $this->createSubscription($company);
                $this->createIndicators($company);
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

    private function createIndicators(Company $company)
    {
        Organizationalndicator::each(fn($indicator) => $company->organizationalIndicators()->create(['indicator_id' => $indicator->id]));
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

    // private function createSubscription(Company $company)
    // {
    //     $subscription = app(CreateSubscriptionAction::class)->execute(company: $company, employees: $this->employees, amount: $this->amount, type: $this->paymentType);
    //     if($subscription) {session()->forget('subscription_data');}
    // }
}
