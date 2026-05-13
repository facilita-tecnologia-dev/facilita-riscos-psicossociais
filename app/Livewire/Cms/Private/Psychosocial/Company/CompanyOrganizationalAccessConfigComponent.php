<?php

namespace App\Livewire\Cms\Private\Psychosocial\Company;

use App\Models\Company;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CompanyOrganizationalAccessConfigComponent extends Component
{
    public Company $company;

    public ?string $can_access_organizational = null; 

    public array $options = [];

    public function render()
    {
        return view('livewire.cms.private.psychosocial.company.company-organizational-access-config-component');
    }

    public function mount(Company $company)
    {
        $this->company = $company;

        $this->can_access_organizational = $this->company->can_access_organizational;

        $this->options = [
            ['label' => 'Sim', 'value' => 1],
            ['label' => 'Não', 'value' => 0]
        ];
    }

    public function updatedCanAccessOrganizational(bool $value)
    {
        try {
            $this->company->can_access_organizational = $value;
            $this->company->save();

            $this->dispatch('alert:success', "Configuração atualizada!");
        } catch (\Throwable $th) {
            Log::error('Não foi possível atualizar a configuração.', [
                'value' => $value,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', "Não foi possível atualizar a configuração.");
        }
    }
}
