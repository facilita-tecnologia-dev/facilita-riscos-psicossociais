<?php

namespace App\Livewire\Private\Absences;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class AbsenceIndexComponent extends Component
{
    use WithPagination;

    protected $listeners = [
        'absence:created' => 'refresh',
        'absence:updated' => 'refresh',
        'absence:force-deleted' => 'refresh',
    ];

    public function render()
    {    
        return view('livewire.private.absences.absence-index-component', [
            'absences' => $this->fetchAbsences()
        ]);
    }

    public function refresh()
    {
        $this->resetPage();
    }

    private function fetchAbsences(): LengthAwarePaginator
    {
        $query = session('auth:company')->CIDabsences()->with('cid')->orderByDesc('created_at')->paginate(8);
        return $query;
    }
}
