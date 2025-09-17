<?php

namespace Database\Seeders;

use Database\Seeders\ActionPlan\ActionPlanSeeder;
use Database\Seeders\BaseTests\BaseCollectionsSeeder;
use Database\Seeders\Campaigns\CampaignSeeder;
use Database\Seeders\Metrics\MetricsSeeder;
use Database\Seeders\Risks\QuestionRiskSeeder;
use Database\Seeders\Risks\RiskSeeder;
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
            PermissionSeeder::class,
            MetricsSeeder::class,
            ActionPlanSeeder::class,
            CompanySeeder::class,
            RiskSeeder::class,
            CampaignSeeder::class
        ]);
    }
}
