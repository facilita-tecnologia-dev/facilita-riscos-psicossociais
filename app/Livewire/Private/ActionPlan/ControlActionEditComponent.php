<?php

namespace App\Livewire\Private\ActionPlan;

use App\Enums\BaseCollection;
use App\Models\ControlActionType;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ControlActionEditComponent extends Component
{
    #[Computed] 
    public function controlActions()
    {
        return session('auth:company')->usesHSE() 
            ? session('auth:company')->actionPlan
                                    ->controlActions()
                                    ->with(['hazard', 'type'])
                                    ->whereHas('hazard', fn($hazard) => 
                                        $hazard->whereHas('collection', fn($collection) => $collection->where('key', BaseCollection::HSE->value))
                                    )
                                    ->get()->groupBy(['hazard.type', 'gravity'])
            : session('auth:company')->actionPlan
                                    ->controlActions()
                                    ->with(['hazard', 'type'])
                                    ->whereHas('hazard', fn($hazard) => 
                                        $hazard->whereHas('collection', fn($collection) => $collection->where('key', BaseCollection::PROART->value))
                                    )
                                    ->get()->groupBy(['hazard.type', 'gravity', 'type.type']);
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
            'hazard_id' => session('auth:company')->latestPsychosocialCampaign()->collection()->hazards->where('type', $risk)->first()->id,
            'control_action_type_id' => $type ? ControlActionType::firstWhere('type', $type)->id : null,
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
