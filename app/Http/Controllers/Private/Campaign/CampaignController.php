<?php

namespace App\Http\Controllers\Private\Campaign;

use App\Models\Campaign;
use App\Services\Auth\AuthenticationService;
use Illuminate\Support\Facades\Gate;

class CampaignController
{
    public function index()
    {
        Gate::forUser(AuthenticationService::user())->authorize('viewAny', [Campaign::class]);
        return view('private.campaign.index.index');
    }

    public function create()
    {
        Gate::forUser(AuthenticationService::user())->authorize('create', [Campaign::class]);
        return view('private.campaign.create.index');
    }

    public function edit(Campaign $campaign)
    {
        Gate::forUser(AuthenticationService::user())->authorize('edit', [Campaign::class, $campaign]);
        return view('private.campaign.edit.index', compact('campaign'));
    }
}
