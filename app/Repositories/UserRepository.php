<?php

namespace App\Repositories;

use App\Enums\InternalUserRoleEnum;
use App\Enums\RoleEnum;
use App\Imports\UsersImport;
use App\Models\Role;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ValidatedInput;

class UserRepository
{
    public function store(ValidatedInput $data): User
    {
        return DB::transaction(function () use ($data) {
            $user = User::firstWhere('cpf', $data['cpf']);

            if($user){
                session('auth:company')->users()->attach($user, ['role_id', 2]);
            } else{
                $role = RoleEnum::from($data['role']);
                
                $user = User::create($data->except('role'));

                session('auth:company')->users()->attach($user, ['role_id' => $data['role']]);
                
                if($role === RoleEnum::MANAGER){
                    $data['password'] = $user->generateTemporaryPassword();
                    $data['is_temp_password'] = true;
                }     
            }
            
            session(['company' => session('auth:company')->load('users')]);

            return $user;
        });
    }

    public function import(Request $request): mixed
    {
        $import = new UsersImport;

        $import->import($request->file('import_users')->store('temp'));
    
        if ($import->failures()->isNotEmpty()) {
            return $import->failures();
        }
        
        session(['company' => session('auth:company')->load('users')]);
        
        return true;
    }

    public function update(ValidatedInput $data, User $user): User
    {
        return DB::transaction(function () use ($data, $user) {
            $role = RoleEnum::from($data['role']);

            $user->companies()->syncWithoutDetaching([session('auth:company')->id => ['status' => $data['status']]]);
            if($role == RoleEnum::MANAGER && !$user->password){
                $data['password'] = $user->generateTemporaryPassword();
                $data['is_temp_password'] = true;
            }
            
            $user->update($data->except(['role', 'status']));
            
            $user->companies()->sync([session('auth:company')->id => ['role_id' => $role->value]]);

            session(['company' => session('auth:company')->load('users')]);

            return $user;
        });
    }

    public function destroy(User $user): void
    {
        session('auth:company')->users()->detach($user->id);

        session(['company' => session('auth:company')->load('users')]);
    }
}
