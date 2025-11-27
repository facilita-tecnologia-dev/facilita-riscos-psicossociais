<?php

namespace App\Livewire\Private\Psychosocial\Dashboard;

use App\Enums\BaseCollectionType;
use App\Models\Campaign;
use Livewire\Component;

class PsychosocialDashboardComponent extends Component
{
    public Campaign | null $activePsychosocialCampaign;

    public function render()
    {
        return view('livewire.private.psychosocial.dashboard.psychosocial-dashboard-component');
    }

    public function mount()
    {
        $this->activePsychosocialCampaign = session('auth:company')->activeCampaigns()->filter(fn($campaign) => $campaign->collection()->type == BaseCollectionType::PSYCHOSOCIAL)?->first();
    }
}
