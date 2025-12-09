<?php

namespace App\Repositories;

use App\Enums\InternalUserUserRole;
use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use App\Imports\UsersImport;
use App\Models\Company;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\User;
use App\Models\UserCustomPermission;
use App\Models\UserDepartmentPermission;
use App\Services\Auth\AuthenticationService;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ValidatedInput;

class UserRepository
{
    public static function store(Company $company, array $data): mixed
    {
        return DB::transaction(function () use($company, $data) {
            $user = User::create([
                'name' => $data['name'],
                'cpf' => $data['cpf'],
                'email' => $data['email'],
                'birth_date' => $data['birth_date'],
                'gender' => $data['gender'],
                'marital_status' => $data['marital_status'],
                'education_level' => $data['education_level'],
                'department' => $data['department'],
                'occupation' => $data['occupation'],
                'work_shift' => $data['work_shift'],
                'admission' => $data['admission'],
            ]);

            $company->users()->attach($user, ['role_id' => $data['role']]);

            $role = UserRole::from($data['role']);

            if ($role === UserRole::MANAGER) {
                $user->password = $user->generateTemporaryPassword();
                $user->is_temp_password = true;
                $user->save();

                UserDepartmentPermission::create([
                    'company_id' => session('auth:company')->id,
                    'user_id' => $user->id,
                    'department' => $user->department,
                    'allowed' => true,
                ]);
            }
        });
    }

    public static function attach(Company $company, User $user, string $role): mixed
    {
        return DB::transaction(function() use($company, $user, $role) {
            $company->users()->attach($user, ['role_id' => $role]);

            if ($role === UserRole::MANAGER) {
                if(!$user->password){
                    $user->password = $user->generateTemporaryPassword();
                    $user->is_temp_password = true;
                    $user->save();
                }

                UserDepartmentPermission::create([
                    'company_id' => session('auth:company')->id,
                    'user_id' => $user->id,
                    'department' => $user->department,
                    'allowed' => true,
                ]);
            }
        });
    }

    public static function import(Company $company, $file): mixed
    {
        $import = new UsersImport($company);

        $import->import($file->store('temp'));

        if ($import->failures()->isNotEmpty()) {
            return $import->failures();
        }

        return true;
    }

    public static function update(Company $company, User $user, array $data): mixed
    {
        return DB::transaction(function () use($company, $user, $data) {
            $user->update([
                'name' => $data['name'],
                'cpf' => $data['cpf'],
                'email' => $data['email'],
                'birth_date' => $data['birth_date'],
                'gender' => $data['gender'],
                'marital_status' => $data['marital_status'],
                'education_level' => $data['education_level'],
                'department' => $data['department'],
                'occupation' => $data['occupation'],
                'work_shift' => $data['work_shift'],
                'admission' => $data['admission'],
            ]);

            $user->companies()->syncWithoutDetaching([$company->id => ['role_id' => (int) $data['role']]]);

            $role = UserRole::from($data['role']);

            if ($role === UserRole::MANAGER) {
                if(!$user->password){
                    $user->password = $user->generateTemporaryPassword();
                    $user->is_temp_password = true;
                    $user->save();
                }

                UserDepartmentPermission::create([
                    'company_id' => session('auth:company')->id,
                    'user_id' => $user->id,
                    'department' => $user->department,
                    'allowed' => true,
                ]);
            }
        });
    }

    public static function updatePermissions(User $user, Collection $default_permissions, Collection $current_permissions, array $new_permissions): mixed
    {
        return DB::transaction(function() use($user, $default_permissions, $current_permissions, $new_permissions) {
            $default_permissions->load('permission');
            $current_permissions->load('permission');

            foreach ($new_permissions as $keyName => $data) {
                $value = $data['allowed'];

                $default = $default_permissions
                    ->where('permission.key_name', $keyName)
                    ->first();

                $custom = $current_permissions
                    ->where('permission.key_name', $keyName)
                    ->first();

                if ($default && $default->allowed == $value) {
                    if ($custom) {$custom->delete();}
                    continue;
                }

                if (! $custom) {
                    $permissionId = Permission::where('key_name', $keyName)->value('id');

                    UserCustomPermission::create([
                        'company_id' => session('auth:company')->id,
                        'user_id' => $user->id,
                        'permission_id' => $permissionId,
                        'allowed' => $value,
                    ]);
                } else {
                    $custom->allowed = $value;
                    $custom->save();
                }
            }
        });
    }

    public static function activate(Company $company, User $user): mixed
    {
        return DB::transaction(function() use($company, $user) {
            $user->companies()->syncWithoutDetaching([$company->id => ['status' => UserStatus::ACTIVE->value]]);
        });
    }

    public static function inactivate(Company $company, User $user): mixed
    {
        return DB::transaction(function() use($company, $user) {
            $user->companies()->syncWithoutDetaching([$company->id => ['status' => UserStatus::INACTIVE->value]]);
        });
    }
}
