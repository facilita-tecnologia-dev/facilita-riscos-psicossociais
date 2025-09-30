<?php

namespace App\Livewire\Private\ActionPlan;

use App\Models\ControlActionType;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ControlActionEditComponent extends Component
{
    #[Computed] 
    public function controlActions()
    {
        return session('auth:company')->actionPlan->controlActions()->with(['risk', 'type'])->get()->groupBy(['risk.type', 'gravity', 'type.type']);
    }

    protected $listeners = [
        'control-action:add' => 'load',
        'control-action:update' => 'load',
        'control-action:delete' => 'load',
    ];

    public function render()
    {
        return view('livewire.private.action-plan.control-action-edit-component');
    }

    public function create($risk, $type, $gravity)
    {
        session('auth:company')->actionPlan->controlActions()->create([
            'risk_id' => session('auth:company')->latestPsychosocialCampaign()->collection()->risks->where('type', $risk)->first()->id,
            'control_action_type_id' => ControlActionType::firstWhere('type', $type)->id,
            'gravity' => $gravity,
            'content' => 'Indefinido',
        ]);

        $this->dispatch('alert:success', 'Medida adicionada!');
    }

    public function load()
    {
        session('auth:company')->load('actionPlan.controlActions');
    }
}
