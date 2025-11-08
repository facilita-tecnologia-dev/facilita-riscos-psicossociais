<?php

namespace App\Livewire\CMS\Private\ReportChannel\User;

use App\Services\ReportChannelService;
use Livewire\Attributes\On;
use Livewire\Component;

class UserIndexComponent extends Component
{
    public $filters = [];

    public function render()
    {
        return view('livewire.cms.private.report-channel.user.user-index-component', [
            'users' => $this->fetchUsers()
        ]);
    }

    #[On('user-list:filter')]
    public function updateFilters($filters)
    {
        $this->filters = $filters;
    }

    #[On('user-list:filter-clear')]
    public function clearFilters()
    {
        $this->reset('filters');
    }

    private function fetchUsers(): mixed
    {
        return ReportChannelService::users($this->filters);
    }
}
