<?php

namespace App\Livewire\Private\Psychosocial\ControlAction;

use App\Enums\Campaign\MetodologyType;
use App\Enums\Psychosocial\HSE\HSEHazard;
use App\Enums\Psychosocial\HSE\HSERisk;
use App\Enums\Psychosocial\HSE\HSERiskMatrix;
use App\Enums\Psychosocial\PROART\PROARTHazard;
use App\Enums\Psychosocial\PROART\PROARTRisk;
use App\Models\ControlActionType;
use App\Models\Hazard;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class ControlActionEditComponent extends Component
{
    public array $controlActions;

    public ?string $hazard = null;
    public ?string $risk_level = null;

    public array $hazards = [];
    public array $risk_levels = [];

    public function render()
    {
        return view('livewire.private.psychosocial.control-action.control-action-edit-component');
    }

    public function mount()
    {
        $this->controlActions = $this->getControlActions();

        $this->hazards = array_merge([['label' => 'Todos', 'value' => '']], array_map(fn ($hazard) => ['label' => $hazard->label(), 'value' => $hazard->value], (session('auth:company')->usesHSE() ? HSEHazard::cases() : PROARTHazard::cases())));
        $this->risk_levels = array_merge([['label' => 'Todos', 'value' => '']], array_map(fn ($risk) => ['label' => session('auth:company')->usesHSE() && session('auth:company')->risk_matrix == HSERiskMatrix::AIHA ? $risk->aiha() : $risk->default(), 'value' => $risk->value], (session('auth:company')->usesHSE() ? HSERisk::cases() : PROARTRisk::cases())));
    }

    public function filter()
    {
        $this->validate([
            'hazard' => ['nullable', Rule::enum(session('auth:company')->usesHSE() ? HSEHazard::class : PROARTHazard::class)],
            'risk_level' => ['nullable', Rule::enum(session('auth:company')->usesHSE() ? HSERisk::class : PROARTRisk::class)],
        ]);

        $this->controlActions = $this->getControlActions();
        $this->dispatch('alert:success', 'Avaliação de Riscos Psicossociais filtrada!');
    }

    public function getControlActions()
    {
        $methodology = session('auth:company')->usesHSE()
                ? MetodologyType::HSE->value
                : MetodologyType::PROART->value;

        $grouping = session('auth:company')->usesHSE()
                ? ['hazard.type', 'gravity']
                : ['hazard.type', 'gravity', 'type.type'];

        $controlActions = session('auth:company')->actionPlan
            ->controlActions()
            ->with(['hazard', 'type'])
            ->whereHas('hazard', function ($hazard) use ($methodology) {
                $hazard->whereHas('collection', function ($collection) 
                    use ($methodology) {
                        $collection->where('key', $methodology);
                });
            })
            ->when($this->hazard, function ($query, $hazardType) {
                $query->whereHas('hazard', function ($hazardQuery) use ($hazardType) {
                    $hazardQuery->where('type', $hazardType);
                });
            })
            ->when($this->risk_level, function ($query, $riskLevel) {
                $query->where('gravity', $riskLevel);
            })
            ->get()
            ->groupBy($grouping)
            ->toArray();

        return $controlActions;
    }
    
    public function create(string $hazard, ?string $type = null, string $gravity)
    {
        try {
            $newControlAction = session('auth:company')->actionPlan->controlActions()->create([
                'hazard_id' => Hazard::where('type', $hazard)->first()->id,
                'control_action_type_id' => $type ? ControlActionType::firstWhere('type', $type)->id : null,
                'gravity' => $gravity,
                'content' => 'Indefinido',
                'assignee' => null,
                'deadline' => null,
                'status' => null
            ]);
    
            if(session('auth:company')->usesHSE()){
                $this->controlActions[$hazard][$gravity][] = $newControlAction->load(['hazard', 'type'])->toArray();
            } else {
                $this->controlActions[$hazard][$gravity][$type][] = $newControlAction->load(['hazard', 'type'])->toArray();
            }

            $this->dispatch('alert:success', 'Medida adicionada!');
        } catch (\Throwable $th) {
            Log::error('Erro ao criar medida de controle.', [
                'company' => $this->company->id,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Ocorreu um erro ao criar medida de controle. Tente novamente mais tarde.');
        }
    }
    
    #[On('control-action:update')]
    public function updateControlAction(array $controlAction)
    {
        if(session('auth:company')->usesHSE()){
            foreach ($this->controlActions as &$gravities) {
                foreach ($gravities as &$actions) {
                    foreach ($actions as &$action) {
                        if ($action['id'] == $controlAction['id']) {
                            $action = $controlAction;
                            break 3;
                        }
                    }
                }
            }

        } else {
            foreach ($this->controlActions as &$gravities) {
                foreach ($gravities as &$types) {
                    foreach ($types as &$actions) {
                        foreach ($actions as &$action) {
                            if ($action['id'] == $controlAction['id']) {
                                $action = $controlAction;
                                break 4;
                            }
                        }
                    }
                }
            }
        }
    }
    
    #[On('control-action:delete')]
    public function deleteControlAction($controlActionID)
    {
        if(session('auth:company')->usesHSE()){
            foreach ($this->controlActions as $hazard => &$gravities) {
                foreach ($gravities as $gravity => &$actions) {
                    foreach ($actions as $key => $action) {
                        if ($action['id'] == $controlActionID) {
                            unset($this->controlActions[$hazard][$gravity][$key]);
                            break 3;
                        }
                    }
                }
            }
        } else {
            foreach ($this->controlActions as $hazard => &$gravities) {
                foreach ($gravities as $gravity => &$types) {
                    foreach ($types as $type => &$actions) {
                        foreach ($actions as $index => $action) {
                            if ($action['id'] == $controlActionID) {
                                unset($this->controlActions[$hazard][$gravity][$type][$index]);
                                break 4;
                            }
                        }
                    }
                }
            }
        }
    }
}
