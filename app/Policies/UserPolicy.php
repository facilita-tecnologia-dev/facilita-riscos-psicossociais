<?php

namespace App\Policies;

use App\Models\Campaign;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Contracts\Auth\Authenticatable;

class UserPolicy extends BasePolicy
{
    public function viewAny(Authenticatable $user): bool
    {
        return $this->checkPermission('user_index');
    }

    public function view(Authenticatable $user, User $model): bool
    {
        if(session('auth:guard') === 'user' && session('auth:user')->id === $model->id){
            return true;
        }

        $userInThisCompany = session('auth:company')->allUsers->where('id', $model->id)->isNotEmpty();
        return $this->checkPermission('user_edit') && $userInThisCompany;
    }

    public function create(Authenticatable $user): bool
    {
        return $this->checkPermission('user_create');
    }

    public function edit(Authenticatable $user, User $model): bool
    {
        if(session('auth:guard') === 'user' && session('auth:user')->id === $model->id){
            return true;
        }

        $userInThisCompany = session('auth:company')->allUsers()->where('users.id', $model->id)->exists();
        return $this->checkPermission('user_edit') && $userInThisCompany;
    }

    public function psychosocialDashboard(Authenticatable $user): bool
    {
        return $this->checkPermission('psychosocial_dashboard_view');
    }

    public function psychosocialControlActions(Authenticatable $user): bool
    {
        return $this->checkPermission('control_action_edit');
    }

    public function psychosocialIndicators(Authenticatable $user): bool
    {
        return $this->checkPermission('indicator_edit');
    }

    public function organizationalDashboard(Authenticatable $user): bool
    {
        return $this->checkPermission('organizational_dashboard_view');
    }

    public function organizationalCustomCollections(Authenticatable $user): bool
    {
        return $this->checkPermission('organizational_custom_collection_edit');
    }

    public function documentation(Authenticatable $user): bool
    {
        return $this->checkPermission('documentation_show');
    }
}
