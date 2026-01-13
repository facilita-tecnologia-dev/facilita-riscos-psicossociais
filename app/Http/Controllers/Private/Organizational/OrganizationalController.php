<?php

namespace App\Http\Controllers\Private\Organizational;

use App\Models\Campaign;
use App\Models\CustomCollection;
use App\Models\User;
use App\Models\UserFeedback;
use App\Services\Auth\AuthenticationService;
use Illuminate\Support\Facades\Gate;

class OrganizationalController
{
    public function dashboard(?Campaign $campaign = null)
    {
        if($campaign) Gate::forUser(AuthenticationService::user())->authorize('organizationalDashboard', $campaign);
        return view('private.organizational.dashboard.index', ['campaign'=> $campaign]);
    }

    public function feedback()
    {
        Gate::forUser(AuthenticationService::user())->authorize('viewAny', [UserFeedback::class]);
        return view('private.organizational.feedback.index.index');
    }

    public function customCollectionIndex()
    {
        Gate::forUser(AuthenticationService::user())->authorize('organizationalCustomCollections', [User::class]);
        return view('private.organizational.custom-collection.index.index');
    }

    public function customCollectionEdit(CustomCollection $customCollection)
    {
        Gate::forUser(AuthenticationService::user())->authorize('organizationalCustomCollections', [User::class]);
        return view('private.organizational.custom-collection.edit.index', compact('customCollection'));
    }
}
