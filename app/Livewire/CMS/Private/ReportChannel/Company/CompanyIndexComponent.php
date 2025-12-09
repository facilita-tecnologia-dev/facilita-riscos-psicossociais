<?php

namespace App\Livewire\CMS\Private\ReportChannel\Company;

use App\Services\ReportChannel\ReportChannelService;
use Livewire\Attributes\On;
use Livewire\Component;

class CompanyIndexComponent extends Component
{
    public $filters = [];

    public function render()
    {
        return view('livewire.cms.private.report-channel.company.company-index-component', [
            'companies' => $this->fetchCompanies()
        ]);
    }

    #[On('company-list:filter')]
    public function updateFilters($filters)
    {
        $this->filters = $filters;
    }

    #[On('company-list:filter-clear')]
    public function clearFilters()
    {
        $this->reset('filters');
    }

    private function fetchCompanies(): mixed
    {
        return ReportChannelService::companies($this->filters);
    }
}
