<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Relations\Relation;
use App\Services\User\UserFilterInterface;
use Illuminate\Database\Eloquent\Builder;

class CPFFilter implements UserFilterInterface
{
    public function handle(Builder | Relation $query, \Closure $next): Builder | Relation
    {
        if (request()->filled('cpf')) {
            $query->where('cpf', 'like', '%'.request('cpf').'%');
        }

        return $next($query);
    }
}
