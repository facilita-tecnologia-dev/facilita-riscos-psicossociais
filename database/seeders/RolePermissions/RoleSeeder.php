<?php

namespace Database\Seeders\RolePermissions;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::insert([
            [
                'type' => 'manager',
                'display_name' => 'Gestor Interno',
            ],
            [
                'type' => 'employee',
                'display_name' => 'Colaborador',
            ],
        ]);
    }
}
