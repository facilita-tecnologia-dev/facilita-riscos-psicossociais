<?php

namespace App\Livewire\Private\Home;

use App\Enums\Campaign\CollectionType;
use App\Models\Campaign;
use Livewire\Component;

class UserHomeComponent extends Component
{
    public Campaign | null $activePsychosocialCampaign;
    public Campaign | null $activeOrganizationalCampaign;

    public function render()
    {
        return view('livewire.private.home.user-home-component');
    }

    public function mount()
    {
        $activeCampaigns = session('auth:company')->load('campaigns')->activeCampaigns();
        
        $this->activePsychosocialCampaign = $activeCampaigns->filter(fn($campaign) => $campaign->collection()->type == CollectionType::PSYCHOSOCIAL)?->first();
        $this->activeOrganizationalCampaign = $activeCampaigns->filter(fn($campaign) => $campaign->collection()->type == CollectionType::ORGANIZATIONAL)?->first();
    }
}
