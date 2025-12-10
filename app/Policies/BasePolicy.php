<?php

namespace App\Policies;

use App\Models\User;

abstract class BasePolicy
{
    protected function allowCompany(): bool
    {
        return session('auth:guard') === 'company';
    }

    protected function user(): ?User
    {
        return session('auth:guard') === 'user'
            ? session('auth:user')
            : null;
    }

    protected function checkPermission(string $permission): bool
    {
        if ($this->allowCompany()) {
            return true;
        }

        $user = $this->user();
        return $user?->hasPermission($permission) ?? false;
    }
}
