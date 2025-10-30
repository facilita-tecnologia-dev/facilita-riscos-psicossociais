<?php

namespace App\Livewire\CMS\Private\Psychosocial\User;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class UserListComponent extends Component
{
    #[Reactive]
    public $users;

    public function render()
    {
        return view('livewire.cms.private.psychosocial.user.user-list-component', [
            'users' => $this->users
        ]);
    }

    public function mount(array $users)
    {
        $this->users = $users;
    }
}
