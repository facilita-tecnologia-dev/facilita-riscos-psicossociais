<?php

namespace App\Repositories;

use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use App\Imports\UsersCountImport;
use App\Imports\UsersImport;
use App\Models\Company;
use App\Models\Permission;
use App\Models\User;
use App\Models\UserCustomPermission;
use App\Models\UserDepartmentPermission;
use App\Services\Subscription\CompanySubscriptionLimitService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

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

            $user->companies()->syncWithoutDetaching([$company->id => ['role_id' => $data['role'], 'status' => UserStatus::ACTIVE->value]]);

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
            $user->companies()->syncWithoutDetaching([$company->id => ['role_id' => $role, 'status' => UserStatus::ACTIVE->value]]);

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

    public static function import(Company $company, $file): mixed {
        $tempPath = $file->store('temp');

        $countImport = new UsersCountImport();
        $countImport->import($tempPath);


        if (! CompanySubscriptionLimitService::canImportEmployees($company, $countImport->count)) {
            $availableSlots = CompanySubscriptionLimitService::availableSlots($company);

            Storage::delete($tempPath);

            throw ValidationException::withMessages(['import_users_file' => "O arquivo contém {$countImport->count} funcionários, mas seu plano permite importar apenas {$availableSlots} funcionário(s) adicional(is). Atualize seu plano ou reduza a quantidade de registros do arquivo."]);
        }

        $import = new UsersImport($company);

        $import->import($tempPath);

        Storage::delete($tempPath);

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

    public static function updateDepartmentScopes(User $user, array $department_scopes): mixed
    {
        return DB::transaction(function() use($user, $department_scopes) {
            foreach($department_scopes as $department => $permission){
                $user->departmentScopes()->updateOrCreate([
                    'company_id' => session('auth:company')->id,
                    'department' => $department
                ],[
                    'allowed' => $permission
                ]);
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
