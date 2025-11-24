<?php

namespace App\Livewire\CMS\Private\Psychosocial\Company;

use App\Enums\CampaignStatus;
use App\Models\Company;
use App\Services\ReportChannelService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class CompanyEditComponent extends Component
{
    use WithFileUploads;
    
    public Company $company;

    #[Validate('image|max:5120')] // 1MB Max
    public $logo;

    public string $registerName = '';
    public string $cnpj = '';
    public string $email = '';

    public int $usersCount;
    public string $psychosocialCampaignStatus;
    public bool $hasReportChannel;

    public function render()
    {
        return view('livewire.cms.private.psychosocial.company.company-edit-component');
    }

    public function mount(Company $company)
    {
        $this->company = $company;

        /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
        $s3 = Storage::disk('s3');
        $this->logo = $this->company->logo ? $s3->temporaryUrl($this->company->logo, now()->addMinutes(5)) : null;
        
        $this->registerName = $this->company->name;
        $this->cnpj = $this->company->cnpj;
        $this->email = $this->company->email;

        $this->usersCount = $company->users()->count();
        $this->psychosocialCampaignStatus =   $company->latestPsychosocialCampaign()?->start_date->year == now()->year 
                                            ? $company->latestPsychosocialCampaign()?->status->label()
                                            : 'Sem previsão';

        $this->hasReportChannel = ReportChannelService::hasReportChannel($company);
    }

    public function submit()
    {
        $this->validate([
            'logo' => ['nullable', Rule::when($this->logo instanceof TemporaryUploadedFile,['image', 'max:5120'])],
            'registerName' => ['required', 'string', 'max:255'],
            'cnpj' => ['required', 'max:18', 'cnpj'],
            'email' => ['required', 'email', 'max:100'],
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


        $this->company->update([
            'logo' => $this->logo ? $path : null,
            'name' => $this->registerName,
            'email' => $this->email,
            'cnpj' => $this->cnpj,
        ]);

        $this->logo = $s3->temporaryUrl($path, now()->addMinutes(5));

        $this->dispatch('company:update', company: $this->company->fresh());
        $this->dispatch('alert:success', 'Perfil atualizado!');
    }
}
