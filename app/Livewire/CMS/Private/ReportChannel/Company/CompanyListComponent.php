<?php

namespace App\Livewire\CMS\Private\ReportChannel\Company;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class CompanyListComponent extends Component
{
    #[Reactive]
    public $companies;
    
    public function render()
    {
        return view('livewire.cms.private.report-channel.company.company-list-component', [
            'companies' => $this->companies
        ]);
    }

    public function mount(array $companies)
    {
        $this->companies = $companies;
    }
}
