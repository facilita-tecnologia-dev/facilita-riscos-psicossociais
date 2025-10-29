<?php

namespace App\Livewire\CMS\Private\Psychosocial\Company;

use App\Enums\CampaignStatus;
use App\Models\Company;
use App\Services\ReportChannelService;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class CompanyEditComponent extends Component
{
    use WithFileUploads;
    
    public Company $company;

    #[Validate('image|max:1024')] // 1MB Max
    public $logo;

    public string $name = '';
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
        $this->logo = $this->company->logo;
        $this->name = $this->company->name;
        $this->cnpj = $this->company->cnpj;
        $this->email = $this->company->email;

        $this->usersCount = $company->users()->count();
        $this->psychosocialCampaignStatus =   $company->latestPsychosocialCampaign()->start_date->year == now()->year 
                                            ? $company->latestPsychosocialCampaign()->status->label()
                                            : 'Sem previsão';

        $this->hasReportChannel = ReportChannelService::hasReportChannel($company);
    }

    public function submit()
    {
        $this->validate([
            'logo' => ['nullable', Rule::when($this->logo instanceof TemporaryUploadedFile,['image', 'max:5120'])],
            'name' => ['required', 'string', 'max:255'],
            'cnpj' => ['required', 'max:18', 'cnpj'],
            'email' => ['required', 'email', 'max:100'],
        ]);

        $logoPath = $this->logo instanceof TemporaryUploadedFile ? $this->logo->store('images', 'public') : $this->logo;

        $this->company->update([
            'logo' => $logoPath,
            'name' => $this->name,
            'email' => $this->email,
            'cnpj' => $this->cnpj,
        ]);

        $this->dispatch('company:update', company: $this->company->fresh());
        $this->dispatch('alert:success', 'Perfil atualizado!');
    }

}
