<?php

namespace App\Livewire\Private\Psychosocial\Dashboard;

use Illuminate\Support\Collection;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class PsychosocialCampaignEngagementComponent extends Component
{
    #[Reactive]
    public Collection $engagement;

    public function render()
    {
        return view('livewire.private.psychosocial.dashboard.psychosocial-campaign-engagement-component');
    }

    public function mount(Collection $engagement)
    {
        $this->engagement = $engagement;
    }
}
