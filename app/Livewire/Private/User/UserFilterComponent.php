<?php

namespace App\Livewire\Private\User;

use App\Enums\Psychosocial\UserOrder;
use App\Enums\User\UserStatus;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;

class UserFilterComponent extends Component
{
    public ?string $name = null;
    public ?string $department = null;
    public ?string $status = null;
    public $has_answered_psychosocial_campaign = false;
    public $has_answered_organizational_campaign = false;
    public $orderBy = UserOrder::NAME_ASC->value;

    public $departments = [];
    public $userOrderTypes = [];
    public $userStatusTypes = [];

    public function render()
    {
        return view('livewire.private.user.user-filter-component');
    }

    public function mount()
    {
        $this->status = (string) UserStatus::ACTIVE->value;

        $departments = session('auth:company')->allUsers()
            ->select('department')
            ->distinct()
            ->pluck('department')
            ->toArray();

        $this->departments = array_map(fn ($department) => ['label' => $department, 'value' => $department], $departments);
        $this->userOrderTypes = array_map(fn ($userOrderType) => ['label' => $userOrderType->label(), 'value' => $userOrderType->value], UserOrder::cases());
        $this->userStatusTypes = array_map(fn ($userStatusType) => ['label' => $userStatusType->label(), 'value' => $userStatusType->value], UserStatus::cases());

        $this->dispatch('user-list:filter', ['status' => $this->status, 'orderBy' => $this->orderBy]);
    }

    public function submit()
    {
        $filters = $this->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'department' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'max:255'],
            'has_answered_psychosocial_campaign' => ['nullable'],
            'has_answered_organizational_campaign' => ['nullable'],
            'orderBy' => ['nullable', new Enum(UserOrder::class)],
        ]);

        if ($this->has_answered_psychosocial_campaign === '' || $this->has_answered_psychosocial_campaign === false) {
            $filters['has_answered_psychosocial_campaign'] = null;
        }

        if ($this->has_answered_organizational_campaign === '' || $this->has_answered_organizational_campaign === false) {
            $filters['has_answered_organizational_campaign'] = null;
        }

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
