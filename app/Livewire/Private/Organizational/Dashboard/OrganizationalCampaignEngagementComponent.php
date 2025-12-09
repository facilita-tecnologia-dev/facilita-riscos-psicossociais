<?php

namespace App\Livewire\Private\Organizational\Dashboard;

use Illuminate\Support\Collection;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class OrganizationalCampaignEngagementComponent extends Component
{
    #[Reactive]
    public Collection $engagement;
    
    public function render()
    {
        return view('livewire.private.organizational.dashboard.organizational-campaign-engagement-component');
    }

    public function mount(Collection $engagement)
    {
        $this->engagement = $engagement;
    }
}
