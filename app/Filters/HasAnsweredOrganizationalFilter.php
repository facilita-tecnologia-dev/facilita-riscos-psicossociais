<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Relations\Relation;
use App\Services\User\UserFilterInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class HasAnsweredOrganizationalFilter implements UserFilterInterface
{
    public function handle(Builder | Relation $query, \Closure $next): Builder | Relation
    {
        if (request()->filled('has_answered_organizational')) {
            if (request('has_answered_organizational') == 'Realizado') {
                $query->whereHas('latestOrganizationalClimateCollection', function ($query) {
                    $query->whereYear('created_at', Carbon::now()->year);
                });
            } else {
                $query->whereDoesntHave('latestOrganizationalClimateCollection', function ($query) {
                    $query->whereYear('created_at', Carbon::now()->year);
                });
            }
        }

        return $next($query);
    }
}
