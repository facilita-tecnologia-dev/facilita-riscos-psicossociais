<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Relations\Relation;
use App\Services\User\UserFilterInterface;
use Illuminate\Database\Eloquent\Builder;

class OccupationFilter implements UserFilterInterface
{
    public function handle(Builder | Relation $query, \Closure $next): Builder | Relation
    {
        if (request()->filled('occupation') && !in_array('Todos', request('occupation'))) {
            $query->whereIn('occupation', request('occupation'));
        }

        return $next($query);
    }
}
