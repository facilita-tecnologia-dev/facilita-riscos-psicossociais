<?php

namespace Database\Seeders;

use Database\Seeders\ActionPlan\ActionPlanSeeder;
use Database\Seeders\BaseTests\BaseCollectionsSeeder;
use Database\Seeders\Campaigns\CampaignSeeder;
use Database\Seeders\PROARTIndicator\PROARTIndicatorSeeder;
use Database\Seeders\Risks\HSERiskSeeder;
use Database\Seeders\Risks\PROARTRiskSeeder;
use Database\Seeders\RolePermissions\PermissionSeeder;
use Database\Seeders\RolePermissions\RoleSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            BaseCollectionsSeeder::class,
            RoleSeeder::class,
            PROARTRiskSeeder::class,
            HSERiskSeeder::class,
            PermissionSeeder::class,
            PROARTIndicatorSeeder::class,
            ActionPlanSeeder::class,
            CompanySeeder::class,
            CampaignSeeder::class
        ]);
    }
}
