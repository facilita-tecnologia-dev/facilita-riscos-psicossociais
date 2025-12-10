<?php

namespace App\Policies;

use App\Models\Campaign;
use Illuminate\Contracts\Auth\Authenticatable;

class CampaignPolicy extends BasePolicy
{
    public function viewAny(Authenticatable $user): bool
    {
        return $this->checkPermission('campaign_index');
    }

    public function answer(Authenticatable $user): bool
    {
        if(session('auth:guard') == 'company') return false;
        
        return $this->checkPermission('answer_tests');
    }

    public function create(Authenticatable $user): bool
    {
        return $this->checkPermission('campaign_create');
    }

    public function edit(Authenticatable $user, Campaign $campaign): bool
    {
        return $this->checkPermission('campaign_edit') && ($campaign->company_id === session('auth:company')->id);
    }
}
