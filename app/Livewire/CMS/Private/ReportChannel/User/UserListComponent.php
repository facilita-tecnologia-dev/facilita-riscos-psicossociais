<?php

namespace App\Livewire\Cms\Private\ReportChannel\User;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class UserListComponent extends Component
{
    #[Reactive]
    public $users;
    
    public function render()
    {
        return view('livewire.cms.private.report-channel.user.user-list-component', [
            'users' => $this->users
        ]);
    }

    public function mount(array $users)
    {
        $this->users = $users;
    }
}
