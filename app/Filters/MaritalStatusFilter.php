<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Relations\Relation;
use App\Services\User\UserFilterInterface;
use Illuminate\Database\Eloquent\Builder;

class MaritalStatusFilter implements UserFilterInterface
{
    public function handle(Builder | Relation $query, \Closure $next): Builder | Relation
    {
        if (request()->filled('marital_status')) {
            $query->where('marital_status', request('marital_status'));
        }

        return $next($query);
    }
}
