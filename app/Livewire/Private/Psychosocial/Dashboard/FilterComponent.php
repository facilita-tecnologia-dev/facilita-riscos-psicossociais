<?php

namespace App\Livewire\Private\Psychosocial\Dashboard;

use App\Enums\Psychosocial\HSE\HSEGroup;
use App\Enums\Psychosocial\HSE\HSERisk;
use App\Enums\Psychosocial\PROART\PROARTGroup;
use App\Enums\Psychosocial\PROART\PROARTRisk;
use Illuminate\Validation\Rule;
use Livewire\Component;

class FilterComponent extends Component
{
    public ?string $group = null;
    public ?string $risk_level = null;

    public array $groups = [];
    public array $risk_levels = [];
    
    public function render()
    {
        return view('livewire.private.psychosocial.dashboard.filter-component');
    }

    public function mount()
    {
        $this->groups = array_merge([['label' => 'Todos', 'value' => '']], array_map(fn ($group) => ['label' => $group->label(), 'value' => $group->value], (session('auth:company')->usesHSE() ? HSEGroup::cases() : PROARTGroup::cases())));
        $this->risk_levels = array_merge([['label' => 'Todos', 'value' => '']], array_map(fn ($risk) => ['label' => $risk->label(), 'value' => $risk->value], (session('auth:company')->usesHSE() ? HSERisk::cases() : PROARTRisk::cases())));
    }

    public function submit()
    {
        $filters = $this->validate([
            'group' => ['nullable', Rule::enum(session('auth:company')->usesHSE() ? HSEGroup::class : PROARTGroup::class)],
            'risk_level' => ['nullable', Rule::enum(session('auth:company')->usesHSE() ? HSERisk::class : PROARTRisk::class)],
        ]);

        $this->dispatch('psychosocial-evaluation:filter', $filters);
        $this->dispatch('alert:success', 'Avaliação de Riscos Psicossociais filtrada!');
    }
}
