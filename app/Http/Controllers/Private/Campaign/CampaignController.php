<?php

namespace App\Http\Controllers\Private\Campaign;

use App\Models\Campaign;

class CampaignController
{
    public function index()
    {
        return view('private.campaign.index.index');
    }

    public function create()
    {
        return view('private.campaign.create.index');
    }

    public function edit(Campaign $campaign)
    {
        return view('private.campaign.edit.index', compact('campaign'));
    }
}
