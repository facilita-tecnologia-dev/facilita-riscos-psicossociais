<?php

namespace Database\Seeders\RolePermissions;

use App\Enums\User\UserRole;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::insert([
            [
                'type' => UserRole::MANAGER->value,
                'display_name' => UserRole::MANAGER->label(),
            ],
            [
                'type' => UserRole::EMPLOYEE->value,
                'display_name' => UserRole::EMPLOYEE->label(),
            ],
        ]);
    }
}
