<?php

namespace App\Livewire\Private\Psychosocial\Dashboard;

use App\Enums\Campaign\EvaluationTypes;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ControlPanelComponent extends Component
{
    public string $evaluation_type = EvaluationTypes::DEPARTMENT->value;
    public ?string $department = null;
    public ?string $occupation = null;

    public array $evaluation_types = [];
    public array $departments = [];
    public array $occupations = [];

    public function render()
    {
        return view('livewire.private.psychosocial.dashboard.control-panel-component');
    }

    public function mount()
    {
       $allowedDepartments = [];

        if (session('auth:guard') === 'user') {
            $allowedDepartments = session('auth:user')->getDepartmentScopes(session('auth:user'));
        }

        $this->evaluation_types = array_map(fn ($evaluationType) => ['label' => $evaluationType->label(), 'value' => $evaluationType->value], EvaluationTypes::cases());

        $departments = session('auth:company')->users()
            ->when(
                session('auth:guard') === 'user', 
                fn($q) => $q->whereIn('department', $allowedDepartments)->whereNotNull('department')->where('department', '!=', '')
            )
            ->select('department')
            ->distinct()
            ->pluck('department')
            ->toArray();

        $this->departments = array_merge([['label' => 'Todos', 'value' => '']], array_map(fn ($department) => ['label' => $department, 'value' => $department], $departments));

        $occupations = session('auth:company')->users()
            ->when(
                session('auth:guard') === 'user', 
                fn($q) => $q->whereIn('department', $allowedDepartments)->whereNotNull('department')->where('department', '!=', '')
            )
            ->select('occupation')
            ->distinct()
            ->pluck('occupation')
            ->toArray();

        $this->occupations = array_merge([['label' => 'Todos', 'value' => '']], array_map(fn ($occupation) => ['label' => $occupation, 'value' => $occupation], $occupations));
    }

    public function submit()
    {
        $this->validate([
            'evaluation_type' => ['required', Rule::enum(EvaluationTypes::class)],
            'department' => ['nullable', 'string', 'max:255'],
            'occupation' => ['nullable', 'string', 'max:255'],
        ]);

        $this->dispatch(
            'psychosocial-evaluation:update', 
            $this->evaluation_type, 
            ($this->evaluation_type === EvaluationTypes::DEPARTMENT->value ? $this->department : $this->occupation)
        );
    }
}
