<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Relations\Relation;
use App\Services\User\UserFilterInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class HasAnsweredPsychosocialFilter implements UserFilterInterface
{
    public function handle(Builder | Relation $query, \Closure $next): Builder | Relation
    {
        if (request()->filled('has_answered_psychosocial')) {
            $campaignId = session('auth:company')
                ->latestPsychosocialCampaign()?->id;

            if ($campaignId) {
                if (request('has_answered_psychosocial') === 'Realizado') {
                    $query->whereHas('collections', function ($q) use ($campaignId) {
                        $q->where('campaign_id', $campaignId);
                    });
                } else {
                    $query->whereDoesntHave('collections', function ($q) use ($campaignId) {
                        $q->where('campaign_id', $campaignId);
                    });
                }
            }
        }

        return $next($query);
    }
}
