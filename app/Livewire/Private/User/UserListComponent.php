<?php

namespace App\Livewire\Private\User;

use Illuminate\Support\Collection;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class UserListComponent extends Component
{
    #[Reactive]
    public Collection $users;

    public function render()
    {
        return view('livewire.private.user.user-list-component');
    }
}
