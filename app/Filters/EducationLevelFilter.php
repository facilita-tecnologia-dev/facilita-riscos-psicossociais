<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Relations\Relation;
use App\Services\User\UserFilterInterface;
use Illuminate\Database\Eloquent\Builder;

class EducationLevelFilter implements UserFilterInterface
{
    public function handle(Builder | Relation $query, \Closure $next): Builder | Relation
    {
        if (request()->filled('education_level')) {
            $query->where('education_level', request('education_level'));
        }

        return $next($query);
    }
}
