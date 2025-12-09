<?php

namespace Database\Seeders\CIDS;

use App\Enums\Psychosocial\HSE\HSECID;
use App\Models\CID;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CIDSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CID::insert([
            [
                'type' => HSECID::F32->value
            ],
            [
                'type' => HSECID::F33->value
            ],
            [
                'type' => HSECID::F34->value
            ],
            [
                'type' => HSECID::F40->value
            ],
            [
                'type' => HSECID::F41->value
            ],
            [
                'type' => HSECID::F43_0->value
            ],
            [
                'type' => HSECID::F43_1->value
            ],
            [
                'type' => HSECID::F43_2->value
            ],
            [
                'type' => HSECID::F43_8->value
            ],
            [
                'type' => HSECID::F43_9->value
            ],
            [
                'type' => HSECID::Z73_0->value
            ],
        ]);

        $this->call([
            HazardCIDSeeder::class,
        ]);
    }
}
