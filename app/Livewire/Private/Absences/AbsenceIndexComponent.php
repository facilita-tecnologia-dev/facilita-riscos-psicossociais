<?php

namespace App\Livewire\Private\Absences;

use App\Models\CID;
use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class AbsenceIndexComponent extends Component
{
    use WithPagination;

    public Company $company;

    protected $listeners = [
        'absence:created' => 'refresh',
        'absence:updated' => 'refresh',
        'absence:force-deleted' => 'refresh',
    ];

    public function render()
    {    
        return view('livewire.private.absences.absence-index-component', [
            'absences' => $this->fetchAbsences(),
            'cids' => CID::all()
        ]);
    }

    public function mount()
    {
        $this->company = session('auth:company');
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
    
    public function toggleAbsenceConfig()
    {
        $this->company->has_cids = !$this->company->has_cids;
        $this->company->save();

        session(['auth:company' => $this->company]);

        $this->dispatch('alert:success', 'Configuração atualizada com sucesso!');
    }
}
