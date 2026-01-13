<?php

namespace App\Policies;

use App\Enums\Campaign\CollectionType;
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

    public function psychosocialDashboard(Authenticatable $user, Campaign $campaign): bool
    {
        return $this->checkPermission('psychosocial_dashboard_view') && $campaign->company_id === session('auth:company')->id && $campaign->collection()->type === CollectionType::PSYCHOSOCIAL;
    }
    
    public function organizationalDashboard(Authenticatable $user, Campaign $campaign): bool
    {
        return $this->checkPermission('organizational_dashboard_view') && $campaign->company_id === session('auth:company')->id && $campaign->collection()->type === CollectionType::ORGANIZATIONAL;
    }
}
