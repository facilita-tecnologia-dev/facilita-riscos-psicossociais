<?php

namespace App\Livewire\Private\Psychosocial\Dashboard;

use App\Models\Campaign;
use Livewire\Component;

class ActionsComponent extends Component
{
    public Campaign | null $psychosocialCampaign;

    public function render()
    {
        return view('livewire.private.psychosocial.dashboard.actions-component');
    }

    public function mount(Campaign $campaign){
        $this->psychosocialCampaign = $campaign;
    }
}
