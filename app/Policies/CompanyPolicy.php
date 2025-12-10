<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Contracts\Auth\Authenticatable;

class CompanyPolicy extends BasePolicy
{
    public function view(Authenticatable $user, Company $model): bool
    {
        return false;
    }

    public function show(Authenticatable $user, Company $model): bool
    {
        return $model->id === session('auth:company')->id && $this->checkPermission('company_show');
    }

    public function edit(Authenticatable $user, Company $model): bool
    {
        return $model->id === session('auth:company')->id && $this->checkPermission('company_edit');
    }
}
