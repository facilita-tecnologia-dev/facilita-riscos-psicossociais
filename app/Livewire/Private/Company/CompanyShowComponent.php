<?php

namespace App\Livewire\Private\Company;

use App\Models\Company;
use App\Models\Subscription;
use Livewire\Component;

class CompanyShowComponent extends Component
{
    public Company $company;

    public function render()
    {
        return view('livewire.private.company.company-show-component');
    }

    public function mount(Company $company)
    {
        $this->company = $company;
    }
}
