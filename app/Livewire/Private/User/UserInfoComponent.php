<?php

namespace App\Livewire\Private\User;

use App\Models\User;
use Livewire\Component;

class UserInfoComponent extends Component
{
    public User $user;

    public string $status;
    public string $role;

    public function render()
    {
        return view('livewire.private.user.user-info-component');
    }

    public function mount(User $user)
    {
        $this->user = $user;
        $this->status = $this->user->status(session('auth:company'));
        $this->role = $this->user->role(session('auth:company'))->type;
    }
}
