<?php

namespace Database\Seeders\RolePermissions;

use App\Enums\RoleEnum;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::insert([
            [
                'type' => RoleEnum::MANAGER->value,
                'display_name' => RoleEnum::MANAGER->label(),
            ],
            [
                'type' => RoleEnum::EMPLOYEE->value,
                'display_name' => RoleEnum::EMPLOYEE->label(),
            ],
        ]);
    }
}
