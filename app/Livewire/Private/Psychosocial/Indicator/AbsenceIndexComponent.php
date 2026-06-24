<?php

namespace App\Livewire\Private\Psychosocial\Indicator;

use App\Models\CID;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class AbsenceIndexComponent extends Component
{
    protected $listeners = [
        'absence:created' => 'refresh',
        'absence:updated' => 'refresh',
        'absence:force-deleted' => 'refresh',
        'absence:config-updated' => 'refresh',
    ];

    public Collection $absences;
    public Collection $cids;

    public function render()
    {
        return view('livewire.private.psychosocial.indicator.absence-index-component');
    }

    public function mount()
    {
        $this->absences = $this->fetchAbsences();
        $this->cids =  CID::all();
    }
    
    public function refresh()
    {
        $this->absences = $this->fetchAbsences();
    }

    private function fetchAbsences(): Collection
    {
        return session('auth:company')->CIDabsences()->with('cid')->orderByDesc('created_at')->get();
    }
}
