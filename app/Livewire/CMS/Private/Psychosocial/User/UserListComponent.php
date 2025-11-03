<?php

namespace App\Livewire\CMS\Private\Psychosocial\User;

use App\Models\Company;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class UserListComponent extends Component
{
    public Company $company;

    #[Reactive]
    public $users;

    public function render()
    {
        return view('livewire.cms.private.psychosocial.user.user-list-component', [
            'users' => $this->users
        ]);
    }

    public function mount(Company $company, array $users)
    {
        $this->users = $users;
    }
}
