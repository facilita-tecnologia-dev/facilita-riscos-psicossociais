<?php

namespace App\Livewire\Private\Organizational\Dashboard;

use App\Enums\OC\OCVisualization;
use Livewire\Component;

class VisualizationTypeComponent extends Component
{
    public string $visualization_type = OCVisualization::GENERAL->value;

    public array $visualization_types = [];

    public function render()
    {
        return view('livewire.private.organizational.dashboard.visualization-type-component');
    }

    public function mount()
    {
        $this->visualization_types = array_map(fn ($visualizationType) => ['label' => $visualizationType->label(), 'value' => $visualizationType->value], OCVisualization::cases());
    }

    public function updatedVisualizationType($value)
    {
        $this->dispatch('organizational-evaluation:update-visualization', $value);
    }
}
