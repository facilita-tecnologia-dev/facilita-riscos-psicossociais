<?php

namespace App\Livewire\Private\Organizational\Dashboard;

use App\Enums\OC\OCGroup;
use Illuminate\Validation\Rule;
use Livewire\Component;

class FilterComponent extends Component
{
    public ?string $group = null;

    public array $groups = [];    

    public function render()
    {
        return view('livewire.private.organizational.dashboard.filter-component');
    }

    public function mount()
    {
        $this->groups = array_merge([['label' => 'Todos', 'value' => '']], array_map(fn ($group) => ['label' => $group->label(), 'value' => $group->value], OCGroup::cases()));
    }
    
    public function submit()
    {
        $filters = $this->validate([
            'group' => ['nullable', Rule::enum(OCGroup::class)],
        ]);

        $this->dispatch('organizational-evaluation:filter', $filters);
        $this->dispatch('alert:success', 'Pesquisa de Clima Organizacional filtrada!');
    }
}
