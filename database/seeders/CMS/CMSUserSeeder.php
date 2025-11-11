<?php

namespace Database\Seeders\CMS;

use App\Models\CMSUser;
use Illuminate\Database\Seeder;

class CMSUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CMSUser::create(['user' => 'facilita.code', 'password' => 'F@cilita3015']);
    }
}
