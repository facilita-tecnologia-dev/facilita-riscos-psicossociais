<?php

namespace Database\Seeders\ActionPlan;

use Illuminate\Database\Seeder;

class ActionPlanSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PROARTControlActionTypesSeeder::class,
            PROARTControlActionsSeeder::class,
        ]);
    }
}
