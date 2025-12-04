<?php

namespace App\Livewire\Private\User;

use Illuminate\Support\Collection;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class UserListComponent extends Component
{
    #[Reactive]
    public Collection $users;

    // public Campaign $latestPsychosocialCampaign;
    // public Campaign $latestOrganizationalCampaign;

    public function render()
    {
        return view('livewire.private.user.user-list-component');
    }

    // public function mount()
    // {
    //     // $this->users = $users;
    //     $this->latestPsychosocialCampaign = session("auth:company")->latestPsychosocialCampaign();
    //     $this->latestOrganizationalCampaign = session("auth:company")->latestOrganizationalCampaign();
    // }
}
