<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\CustomResetPassword;
use App\Notifications\ResetPassword;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    
    protected $cachedPermissionMap;

    /* ---- Relations ---- */
    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_user')
            ->withPivot('role_id', 'status');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'company_user')
                    ->withPivot('company_id', 'role_id');
    }

    public function feedbacks(): HasMany
    {
        return $this->hasMany(UserFeedback::class);
    }

    public function collections(): HasMany
    {
        return $this->hasMany(UserCollection::class)
                    ->where('company_id', session('auth:company')->id);
    }

    public function departmentScopes(): HasMany
    {
        return $this->hasMany(UserDepartmentPermission::class, 'user_id');
    }

    /* ---- End Relations ---- */

    /* ---- Aux/Verifiers/Conditionals ---- */
    public function hasAnsweredCampaign($campaignID): bool
    {
        return $this->collections->where('campaign_id', $campaignID)->isNotEmpty();
    }

    public function status(?Company $company = null)
    {
        $company = $company ?? session('auth:company');
        return $this->companies()->where('companies.id', $company->id)->first()['pivot']['status'];
    }

    public function role(?Company $company = null): Role
    {
        $company = $company ?? session('auth:company');
        return $this->roles()->wherePivot('company_id', $company->id)->first();
    }

    public function hasRole(string $role): bool
    {
        return $this->role()->type == $role;
    }

    public function hasPermission(string $key): bool
    {
        if (!$this->cachedPermissionMap) {
            $this->cachedPermissionMap = $this->loadPermissions();
        }

        // 1. Verifica se existe permissão customizada explícita (allowed ou denied)
        if (array_key_exists($key, $this->cachedPermissionMap['custom'])) {
            return $this->cachedPermissionMap['custom'][$key] === true;
        }

        // 2. Caso contrário, verifica se está permitida via papel
        return in_array($key, $this->cachedPermissionMap['role']);
    }

    private function loadPermissions(): array
    {
        $companyId = session('auth:company')->id;

        // 1. Permissões customizadas por usuário (tanto allowed quanto denied)
        $custom = DB::table('user_custom_permissions')
            ->join('permissions', 'permissions.id', '=', 'user_custom_permissions.permission_id')
            ->where('user_custom_permissions.user_id', $this->id)
            ->where('user_custom_permissions.company_id', $companyId)
            ->select('permissions.key_name', 'user_custom_permissions.allowed')
            ->get()
            ->mapWithKeys(fn($row) => [$row->key_name => (bool) $row->allowed])
            ->toArray();

        // 2. Papel do usuário
        $roleId = DB::table('company_user')
            ->where('user_id', $this->id)
            ->where('company_id', $companyId)
            ->value('role_id');

        // 3. Permissões por papel (somente allowed)
        $rolePermissions = [];

        if ($roleId) {
            $rolePermissions = DB::table('role_permission')
                ->join('permissions', 'permissions.id', '=', 'role_permission.permission_id')
                ->where('role_permission.role_id', $roleId)
                ->where('role_permission.allowed', true)
                ->pluck('permissions.key_name')
                ->toArray();
        }

        return [
            'custom' => $custom,              // key => bool (true/false)
            'role'   => $rolePermissions,     // array de key_name
        ];
    }

    /* ---- End Aux/Verifiers/Conditionals ---- */

    
    public static function generateTemporaryPassword(): string
    {
        return 'temp_' . bin2hex(random_bytes(5));
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token, 'user'));
    }
}
