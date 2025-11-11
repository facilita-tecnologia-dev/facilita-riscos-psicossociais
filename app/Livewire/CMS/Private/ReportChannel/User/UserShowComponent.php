<?php

namespace App\Livewire\CMS\Private\ReportChannel\User;

use App\Services\ReportChannelService;
use Livewire\Component;

class UserShowComponent extends Component
{
    public array $user;

    public function render()
    {
        return view('livewire.cms.private.report-channel.user.user-show-component');
    }

    public function mount(string $userID)
    {
        $this->user = ReportChannelService::user($userID);
    }
}
