<?php

namespace App\Livewire\Cms\Private\Psychosocial\Company;

use App\Enums\Campaign\MetodologyType;
use App\Enums\Psychosocial\HSE\HSERiskMatrix;
use App\Enums\Psychosocial\PROART\PROARTHazard;
use App\Enums\Subscription\AccessStatus;
use App\Enums\Subscription\SubscriptionStatus;
use App\Models\BaseControlAction;
use App\Models\Company;
use App\Models\CompanyReport;
use App\Models\Organizationalndicator;
use App\Services\Subscription\CompanyNotificationService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class CompanyCreateComponent extends Component
{
    use WithFileUploads;

    #[Validate('image|max:5120')] // 1MB Max
    public $logo;

    public ?string $registerName = null;
    public ?string $cnpj = null;
    public ?string $email = null;
    public ?string $psychosocialMetodology = MetodologyType::HSE->value;
    public ?string $riskMatrix = HSERiskMatrix::DEFAULT->value;
    public ?string $password = null;
    public ?string $passwordConfirmation = null;

    public array $riskMatrixes;

    public function render()
    {
        return view('livewire.cms.private.psychosocial.company.company-create-component');
    }

    public function mount()
    {
        $this->riskMatrixes = array_map(fn ($userOrderType) => ['label' => $userOrderType->label(), 'value' => $userOrderType->value], HSERiskMatrix::cases());
    }

    public function submit()
    {
        $this->validate([
            'logo' => ['nullable', Rule::when($this->logo instanceof TemporaryUploadedFile,['image', 'max:5120'])],
            'registerName' => ['required', 'string', 'max:255'],
            'cnpj' => ['required', 'max:18', 'cnpj'],
            'email' => ['required', 'email', 'max:100'],
            'riskMatrix' => ['required', new Enum(HSERiskMatrix::class)],
            'password' => ['required', 'string', 'max:100', Password::defaults()],
            'passwordConfirmation' => ['required', 'string', 'same:password', 'max:100'],
        ]);

        if($this->logo){
            /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
            $s3 = Storage::disk('s3');
            $path = $s3->putFileAs(
                env('AWS_COMPANY_LOGO_PATH'),
                $this->logo,
                uniqid() . '.' . $this->logo->getClientOriginalExtension()
            );
        }

        $company = Company::create([
            'logo' => $this->logo ? $path : null,
            'name' => $this->registerName,
            'email' => $this->email,
            'cnpj' => $this->cnpj,
            'psychosocial_collection_type' => $this->psychosocialMetodology,
            'risk_matrix' => $this->riskMatrix,
            'password' => $this->password,

            'billing_managed_externally' => true,

            'subscription_status' => SubscriptionStatus::ACTIVE,
            'access_status' => AccessStatus::ACTIVE,

            'trial_started_at' => null,
            'trial_ends_at' => null,
            'trial_expired_at' => null,
            'trial_expired_reason' => null,
        ]);

        $this->createIndicators($company);
        $this->createReports($company);
        $this->createActionPlan($company);

        if($this->logo){
            $this->logo = $s3->temporaryUrl($path, now()->addMinutes(5));
        }
        
        CompanyNotificationService::notifyExternalCompany($company);
        
        $this->dispatch('alert:success', 'Empresa cadastrada!');

        return redirect()->to(route('cms.psychosocial.company.show', $company));
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
}
