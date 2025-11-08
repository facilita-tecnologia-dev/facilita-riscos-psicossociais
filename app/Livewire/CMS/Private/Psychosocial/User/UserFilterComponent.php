<?php

namespace App\Livewire\CMS\Private\Psychosocial\User;

use App\Enums\Filters\PsychosocialUserOrder;
use App\Models\Company;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;

class UserFilterComponent extends Component
{
    public Company $company;

    public $name = '';
    public $cpf = '';
    public $department = '';
    public $orderBy = PsychosocialUserOrder::NAME_ASC->value;

    public $departments = [];
    public $userOrderTypes = [];

    public function render()
    {
        return view('livewire.cms.private.psychosocial.user.user-filter-component');
    }

    public function mount(Company $company)
    {
        $departments = $company->users()
            ->select('department')
            ->distinct()
            ->pluck('department')
            ->toArray();

        $this->departments = array_merge([['label' => 'Todos', 'value' => '']], array_map(fn ($department) => ['label' => $department, 'value' => $department], $departments));
        $this->userOrderTypes = array_map(fn ($userOrderType) => ['label' => $userOrderType->label(), 'value' => $userOrderType->value], PsychosocialUserOrder::cases());
    }

    public function submit()
    {
        $filters = $this->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'cpf' => ['nullable', 'string', 'max:255'],
            'department' => ['nullable', 'string', 'max:255'],
            'orderBy' => ['nullable', new Enum(PsychosocialUserOrder::class)],
        ]);

        $this->dispatch('user-list:filter', $filters);
        $this->dispatch('alert:success', 'Lista de usuários filtrada!');
    }

    public function clear()
    {
        $this->reset(['name', 'cpf', 'department']);
        $this->dispatch('user-list:filter-clear');
        $this->dispatch('alert:success', 'Filtros removidos!');
    }
}
