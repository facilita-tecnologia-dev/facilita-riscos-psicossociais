<?php

namespace App\Livewire\Private\Company;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CompanyCidConfigComponent extends Component
{
    public bool $cid_config; 

    public array $cid_options = [];

    public function render()
    {
        return view('livewire.private.company.company-cid-config-component');
    }

    public function mount()
    {
        $this->cid_config = session('auth:company')->has_cids;

        $this->cid_options = [
            ['label' => 'Tenho', 'value' => 1],
            ['label' => 'Não tenho', 'value' => 0]
        ];
    }

    public function updatedCidConfig(bool $value)
    {
        try {
            session('auth:company')->has_cids = $value;
            session('auth:company')->save();

            $this->dispatch('absence:config-updated');
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
