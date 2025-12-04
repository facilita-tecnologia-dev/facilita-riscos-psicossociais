<?php

namespace App\Livewire\Private\Psychosocial\Absence;

use App\Jobs\SoftDeleteAbsenceAfterDeadline;
use App\Models\CID;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class AbsenceCreateComponent extends Component
{
    public ?string $cid = null; 
    public ?string $department = null; 
    public ?string $occupation = null; 
    public ?string $duration = null; 
    
    public Collection $cids; 
    public Collection $departments; 
    public Collection $occupations; 

    public function render()
    {
        return view('livewire.private.psychosocial.absence.absence-create-component');
    }

    public function mount(Collection $cids)
    {
        $users = session('auth:company')->users()->get();

        $this->cids = $cids->map(fn($cid) => ['label' => $cid->type, 'value' => $cid->id]);
        $this->departments = $users->pluck('department')->unique()->map(fn($department) => ['label' => $department, 'value' => $department]);
        $this->occupations = $users->pluck('occupation')->unique()->map(fn($occupation) => ['label' => $occupation, 'value' => $occupation]);
    }

    public function create()
    {
        $this->validate([
            'cid' => ['required'],
            'department' => ['required'],
            'occupation' => ['required'],
            'duration' => ['required'],
        ]);

        try {
            DB::transaction(function(){
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
            });    
        } catch (\Throwable $th) {
            Log::error('Erro ao registrar afastamento', [
                'company' => session('auth:company')->id,
                'cid_id' => $this->cid,
                'department' => $this->department,
                'occupation' => $this->occupation,
                'duration' => $this->duration,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Erro ao registrar afastamento.');
        }
    }
}
