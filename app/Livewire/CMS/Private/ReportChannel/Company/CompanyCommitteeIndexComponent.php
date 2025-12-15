<?php

namespace App\Livewire\Cms\Private\ReportChannel\Company;

use App\Services\ReportChannel\ReportChannelService;
use Livewire\Attributes\On;
use Livewire\Component;

class CompanyCommitteeIndexComponent extends Component
{
    public array $company;
    public array $committee;

    public function render()
    {
        return view('livewire.cms.private.report-channel.company.company-committee-index-component');
    }

    public function mount(array $company)
    {
        $this->company = $company;

        $committee = ReportChannelService::companyCommittee($this->company['id']);
        if($committee) $this->committee = $committee;
    }

    #[On('committee:detached')]
    public function committeeDetached(string $userID)
    {
        $this->committee = array_values(array_filter($this->committee, fn($user) => $user['id'] != $userID));
    }
}
