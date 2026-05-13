<?php

namespace App\Livewire\Private\Psychosocial\Absence;

use App\Models\CompanyAbsence;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class AbsenceEditComponent extends Component
{
    public CompanyAbsence $absence;

    public ?string $cid = null; 
    public ?string $department = null; 
    public ?string $occupation = null; 
    public ?string $duration = null; 

    public Collection $cids; 
    public Collection $departments; 
    public Collection $occupations; 

    public function render()
    {
        return view('livewire.private.psychosocial.absence.absence-edit-component');
    }

    public function mount(CompanyAbsence $absence, Collection $cids)
    {
        $this->absence = $absence;

        $users = session('auth:company')->allUsers;
        
        $this->cid = $absence->cid_id;
        $this->department = $absence->department;
        $this->occupation = $absence->occupation;
        $this->duration = $absence->duration;

        $this->cids = $cids->map(fn($cid) => ['label' => $cid->type, 'value' => $cid->id]);
        $this->departments = $users->pluck('department')->unique()->map(fn($department) => ['label' => $department, 'value' => $department]);
        $this->occupations = $users->pluck('occupation')->unique()->map(fn($occupation) => ['label' => $occupation, 'value' => $occupation]);
    }

    public function update()
    {
        $this->validate([
            'cid' => ['required'],
            'department' => ['required'],
            'occupation' => ['required'],
            'duration' => ['required'],
        ]);

        try {
            DB::transaction(function(){
                $this->absence->update([
                    'cid_id' => $this->cid,
                    'department' => $this->department,
                    'occupation' => $this->occupation,
                    'duration' => $this->duration,
                ]);
                
                $this->dispatch('absence:updated');
                $this->dispatch('alert:success', 'Afastamento atualizado!');
            });
        } catch (\Throwable $th) {
            Log::error('Erro ao atualizar afastamento', [
                'company' => session('auth:company')->id,
                'cid_id' => $this->cid,
                'department' => $this->department,
                'occupation' => $this->occupation,
                'duration' => $this->duration,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Erro ao atualizar afastamento.');
        }

    }
}
