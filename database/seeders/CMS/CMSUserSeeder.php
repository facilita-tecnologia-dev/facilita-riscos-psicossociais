<?php

namespace Database\Seeders\Cms;

use App\Models\CmsUser;
use Illuminate\Database\Seeder;

class CmsUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CmsUser::create(['user' => 'facilita.code', 'password' => 'F@cilita3015']);
    }
}
