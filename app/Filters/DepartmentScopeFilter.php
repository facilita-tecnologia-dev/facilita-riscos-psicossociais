<?php

namespace App\Filters;


use Illuminate\Database\Eloquent\Relations\Relation;
use App\Services\User\UserFilterInterface;
use Illuminate\Database\Eloquent\Builder;

class DepartmentScopeFilter implements UserFilterInterface
{
    public function handle(Builder | Relation $query, \Closure $next): Builder | Relation
    {
        if (session('auth:guard') === 'user') {
            $authUserDepartmentScopes = session('auth:user')->departmentScopes()->where('allowed', true)->pluck('department');

            $query->whereIn('department', $authUserDepartmentScopes);
        }

        return $next($query);
    }
}
