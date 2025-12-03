<?php

namespace App\Livewire\Private\Campaign;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class CampaignIndexComponent extends Component
{
    public Collection $currentYearCampaigns;
    public Collection $previousYearCampaigns;

    public function render()
    {
        return view('livewire.private.campaign.campaign-index-component');
    }

    public function mount()
    {
        $this->currentYearCampaigns  = session('auth:company')->campaigns()->whereYear("start_date", now()->year)->get();
        $this->previousYearCampaigns   = session('auth:company')->campaigns()->whereYear('start_date', '<', now()->year)->get();
    }
}
