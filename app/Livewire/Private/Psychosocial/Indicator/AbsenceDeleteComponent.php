<?php

namespace App\Livewire\Private\Psychosocial\Indicator;

use App\Models\CompanyAbsence;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class AbsenceDeleteComponent extends Component
{
    public CompanyAbsence $absence;

    public function render()
    {
        return view('livewire.private.psychosocial.indicator.absence-delete-component');
    }

    public function mount(CompanyAbsence $absence)
    {
        $this->absence = $absence;
    }

    public function delete()
    {
        try {
            $this->absence->forceDelete();
    
            $this->dispatch('absence:force-deleted');
            $this->dispatch('alert:success', 'Afastamento excluído!');
        } catch (\Throwable $th) {
            Log::error('Erro ao atualizar afastamento', [
                'company' => session('auth:company')->id,
                'absence' => $this->absence->id,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Erro ao excluir afastamento.');
        }
    }
}
