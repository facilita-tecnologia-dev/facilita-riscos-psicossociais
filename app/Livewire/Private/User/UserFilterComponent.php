<?php

namespace App\Livewire\Private\User;

use App\Enums\Psychosocial\UserOrder;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;

class UserFilterComponent extends Component
{
    public ?string $name = null;
    public ?string $department = null;
    public bool $has_answered_psychosocial_campaign = false;
    public bool $has_answered_organizational_campaign = false;
    public $orderBy = UserOrder::NAME_ASC->value;

    public $departments = [];
    public $userOrderTypes = [];

    public function render()
    {
        return view('livewire.private.user.user-filter-component');
    }

    public function mount()
    {
        $departments = session('auth:company')->users()
            ->select('department')
            ->distinct()
            ->pluck('department')
            ->toArray();

        $this->departments = array_map(fn ($department) => ['label' => $department, 'value' => $department], $departments);
        $this->userOrderTypes = array_map(fn ($userOrderType) => ['label' => $userOrderType->label(), 'value' => $userOrderType->value], UserOrder::cases());
    }

    public function submit()
    {
        $filters = $this->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'department' => ['nullable', 'string', 'max:255'],
            'has_answered_psychosocial_campaign' => ['nullable', 'boolean'],
            'has_answered_organizational_campaign' => ['nullable', 'boolean'],
            'orderBy' => ['nullable', new Enum(UserOrder::class)],
        ]);

        $this->dispatch('user-list:filter', $filters);
        $this->dispatch('alert:success', 'Lista de usuários filtrada!');
    }

    public function clear()
    {
        $this->reset(['name', 'department', 'has_answered_psychosocial_campaign', 'has_answered_organizational_campaign']);
        $this->dispatch('user-list:filter-clear');
        $this->dispatch('alert:success', 'Filtros removidos!');
    }
}
