<?php

namespace App\Services\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

interface UserFilterInterface
{
    public function handle(Builder | Relation $query, \Closure $next): Builder | Relation;
}
