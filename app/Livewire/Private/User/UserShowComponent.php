<?php

namespace App\Livewire\Private\User;

use App\Enums\User\UserRole;
use App\Models\Role;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class UserShowComponent extends Component
{
    public User $user;
    public bool $isManager;

    public function render()
    {
        return view('livewire.private.user.user-show-component');
    }

    public function mount(User $user)
    {
        $this->user = $user;
        $this->isManager = $this->user->roles()->where('type', UserRole::MANAGER->value)->exists();
    }

    #[On('user:updated')]
    public function updateUser(User $user)
    {
        $this->user = $user;
        $this->isManager = $this->user->roles()->where('type', UserRole::MANAGER->value)->exists();
    }
}
