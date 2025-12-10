<?php

namespace Database\Seeders\RolePermissions;

use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        RolePermission::insert([
            [
                'role_id' => 2,
                'permission_id' => 1,
                'allowed' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 1,
                'allowed' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 2,
                'allowed' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 3,
                'allowed' => 0,
            ],
            [
                'role_id' => 1,
                'permission_id' => 4,
                'allowed' => 0,
            ],
            [
                'role_id' => 1,
                'permission_id' => 5,
                'allowed' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 6,
                'allowed' => 0,
            ],
            [
                'role_id' => 1,
                'permission_id' => 7,
                'allowed' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 8,
                'allowed' => 0,
            ],
            [
                'role_id' => 1,
                'permission_id' => 9,
                'allowed' => 0,
            ],
            [
                'role_id' => 1,
                'permission_id' => 10,
                'allowed' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 11,
                'allowed' => 0,
            ],
            [
                'role_id' => 1,
                'permission_id' => 12,
                'allowed' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 13,
                'allowed' => 0,
            ],
            [
                'role_id' => 1,
                'permission_id' => 14,
                'allowed' => 1,
            ],
            [
                'role_id' => 1,
                'permission_id' => 15,
                'allowed' => 0,
            ],
            [
                'role_id' => 1,
                'permission_id' => 16,
                'allowed' => 1,
            ],
        ]);
    }
}
