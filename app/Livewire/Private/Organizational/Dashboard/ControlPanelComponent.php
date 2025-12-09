<?php

namespace App\Livewire\Private\Organizational\Dashboard;

use App\Enums\OC\OCEvaluation;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ControlPanelComponent extends Component
{
    public string $evaluation_type = OCEvaluation::DEPARTMENT->value;
    public ?string $department = null;
    public ?string $occupation = null;

    public array $evaluation_types = [];

    public function render()
    {
        return view('livewire.private.organizational.dashboard.control-panel-component');
    }

    public function mount()
    {
        $this->evaluation_types = array_map(fn ($evaluationType) => ['label' => $evaluationType->label(), 'value' => $evaluationType->value], OCEvaluation::cases());
    }

    public function submit()
    {
        $this->validate([
            'evaluation_type' => ['required', Rule::enum(OCEvaluation::class)],
            'department' => ['nullable', 'string', 'max:255'],
            'occupation' => ['nullable', 'string', 'max:255'],
        ]);

        $this->dispatch('organizational-evaluation:update',  $this->evaluation_type);
    }
}
