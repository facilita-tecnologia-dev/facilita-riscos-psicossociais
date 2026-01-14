<?php

namespace App\Livewire\Cms\Private\ReportChannel\Company;

use App\Models\Company;
use App\Services\ReportChannel\ReportChannelService;
use Livewire\Attributes\On;
use Livewire\Component;

class CompanyShowComponent extends Component
{
    public array $company;
    public bool $hasPsychosocial;

    public function render()
    {
        return view('livewire.cms.private.report-channel.company.company-show-component');
    }

    public function mount(string $companyID)
    {
        $this->company = ReportChannelService::company($companyID);
        $this->hasPsychosocial = Company::where('cnpj', $this->company['cnpj'])->exists();
    }

    #[On('company:updated')]
    public function updatedCompany(array $company)
    {
        $this->company = $company;
    }
}
