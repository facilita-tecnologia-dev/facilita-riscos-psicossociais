<?php

namespace Database\Seeders;

use Database\Seeders\ActionPlan\ActionPlanSeeder;
use Database\Seeders\BaseTests\BaseCollectionsSeeder;
use Database\Seeders\BaseTests\HSEQuestions\HSEEnglishTranslationSeeder;
use Database\Seeders\BaseTests\HSEQuestions\HSEFrenchTranslationSeeder;
use Database\Seeders\BaseTests\HSEQuestions\HSESpanishTranslationSeeder;
use Database\Seeders\Campaigns\CampaignSeeder;
use Database\Seeders\CIDS\CIDSeeder;
use Database\Seeders\Cms\CmsUserSeeder;
use Database\Seeders\OrganizationalIndicator\OrganizationalIndicatorSeeder;
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
            // CmsUserSeeder::class,
            // BaseCollectionsSeeder::class,
            // RoleSeeder::class,
            // PROARTRiskSeeder::class,
            // HSERiskSeeder::class,
            // CIDSeeder::class,
            // PermissionSeeder::class,
            // OrganizationalIndicatorSeeder::class,
            // ActionPlanSeeder::class,
            // CompanySeeder::class,
            // CampaignSeeder::class
            HSESpanishTranslationSeeder::class,
            HSEFrenchTranslationSeeder::class,
            HSEEnglishTranslationSeeder::class,
        ]);
    }
}
