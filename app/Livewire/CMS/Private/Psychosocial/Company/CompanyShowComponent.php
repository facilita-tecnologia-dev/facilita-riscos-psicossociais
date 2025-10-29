<?php

namespace App\Livewire\CMS\Private\Psychosocial\Company;

use App\Enums\BaseCollection;
use App\Models\Company;
use Livewire\Attributes\On;
use Livewire\Component;

class CompanyShowComponent extends Component
{
    public Company $company;
    public string $psychosocialMetodology;

    public array $psychosocialMetodologies;

    public function render()
    {
        return view('livewire.cms.private.psychosocial.company.company-show-component');
    }

    public function mount(Company $company)
    {
        $this->company = $company;
        $this->psychosocialMetodology = $company->psychosocial_collection_type;
        $this->psychosocialMetodologies = [
            ['label' => BaseCollection::HSE->label(), 'value' => BaseCollection::HSE->value],
            ['label' => BaseCollection::PROART->label(), 'value' => BaseCollection::PROART->value],
        ];
    }

    #[On('company:update')]
    public function updateCompany(Company $company)
    {
        $this->company = $company;
    }
}
