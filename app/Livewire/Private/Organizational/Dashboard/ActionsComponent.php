<?php

namespace App\Livewire\Private\Organizational\Dashboard;

use App\Models\Campaign;
use Livewire\Component;

class ActionsComponent extends Component
{
    public Campaign | null $organizationalCampaign;

    public function render()
    {
        return view('livewire.private.organizational.dashboard.actions-component');
    }

    public function mount(Campaign $campaign){
        $this->organizationalCampaign = $campaign;
    }
}
