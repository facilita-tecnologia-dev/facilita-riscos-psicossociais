<?php

namespace App\Livewire\Private\Absences;

use App\Models\CompanyAbsence;
use Livewire\Component;

class AbsenceDeleteComponent extends Component
{
    public CompanyAbsence $absence;

    public function render()
    {
        return view('livewire.private.absences.absence-delete-component');
    }

    public function mount(CompanyAbsence $absence)
    {
        $this->absence = $absence;
    }

    public function delete()
    {
        $this->absence->forceDelete();

        $this->dispatch('absence:force-deleted');
        $this->dispatch('alert:success', 'Afastamento excluído!');
    }
}
