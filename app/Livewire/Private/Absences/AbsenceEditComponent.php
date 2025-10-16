<?php

namespace App\Livewire\Private\Absences;

use App\Models\CID;
use App\Models\CompanyAbsence;
use Illuminate\Support\Collection;
use Livewire\Component;

class AbsenceEditComponent extends Component
{
    public CompanyAbsence $absence;

    public string $cid = ''; 
    public string $department = ''; 
    public string $occupation = ''; 
    public string $duration = ''; 

    public Collection $cids; 
    public Collection $departments; 
    public Collection $occupations; 

    public function render()
    {
        return view('livewire.private.absences.absence-edit-component');
    }

    public function mount(CompanyAbsence $absence, Collection $cids)
    {
        $this->absence = $absence;
        $this->cids = $cids;

        $users = session('auth:company')->users;
        
        $this->cid = $absence->cid_id;
        $this->department = $absence->department;
        $this->occupation = $absence->occupation;
        $this->duration = $absence->duration;

        // $this->cids = CID::all()->map(fn($cid) => ['option' => $cid->type, 'value' => $cid->id]);
        $this->departments = $users->pluck('department')->unique()->map(fn($department) => ['option' => $department, 'value' => $department]);
        $this->occupations = $users->pluck('occupation')->unique()->map(fn($occupation) => ['option' => $occupation, 'value' => $occupation]);
    }

    public function update()
    {
        $this->validate([
            'cid' => ['required'],
            'department' => ['required'],
            'occupation' => ['required'],
            'duration' => ['required'],
        ]);

        $this->absence->update([
            'cid_id' => $this->cid,
            'department' => $this->department,
            'occupation' => $this->occupation,
            'duration' => $this->duration,
        ]);

        $this->dispatch('absence:updated');
        $this->dispatch('alert:success', 'Afastamento atualizado!');
    }
}
