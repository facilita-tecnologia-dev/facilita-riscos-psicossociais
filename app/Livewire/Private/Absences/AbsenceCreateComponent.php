<?php

namespace App\Livewire\Private\Absences;

use App\Jobs\SoftDeleteAbsenceAfterDeadline;
use App\Models\CID;
use Illuminate\Support\Collection;
use Livewire\Component;

class AbsenceCreateComponent extends Component
{
    public string $cid = ''; 
    public string $department = ''; 
    public string $occupation = ''; 
    public string $duration = ''; 
    
    public Collection $cids; 
    public Collection $departments; 
    public Collection $occupations; 

    public function render()
    {
        return view('livewire.private.absences.absence-create-component');
    }

    public function mount()
    {
        $users = session('auth:company')->users()->get();

        $this->cids = CID::all()->map(fn($cid) => ['option' => $cid->type, 'value' => $cid->id]);
        $this->departments = $users->pluck('department')->unique()->map(fn($department) => ['option' => $department, 'value' => $department]);
        $this->occupations = $users->pluck('occupation')->unique()->map(fn($occupation) => ['option' => $occupation, 'value' => $occupation]);
    }

    public function create()
    {
        $this->validate([
            'cid' => ['required'],
            'department' => ['required'],
            'occupation' => ['required'],
            'duration' => ['required'],
        ]);

        $absence = session('auth:company')->CIDabsences()->create([
            'cid_id' => $this->cid,
            'department' => $this->department,
            'occupation' => $this->occupation,
            'duration' => $this->duration,
        ]);

        SoftDeleteAbsenceAfterDeadline::dispatch($absence)->delay(now()->addMonths((int) config('app.absence-deadline')));
        
        $this->dispatch('absence:created');
        $this->dispatch('alert:success', 'Afastamento registrado!');
        $this->reset(['cid', 'department', 'occupation', 'duration']);
        
        return;
    }
}
