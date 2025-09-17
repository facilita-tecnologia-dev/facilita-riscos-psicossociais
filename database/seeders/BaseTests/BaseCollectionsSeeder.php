<?php

namespace Database\Seeders\BaseTests;

use App\Enums\BaseCollectionTypes;
use App\Models\BaseCollection;
use Database\Seeders\BaseTests\OrganizationalQuestions\CommunicationAndInformationSeeder;
use Database\Seeders\BaseTests\OrganizationalQuestions\DevelopmentCarreerRecognitionSeeder;
use Database\Seeders\BaseTests\OrganizationalQuestions\EngagementAndPrideSeeder;
use Database\Seeders\BaseTests\OrganizationalQuestions\MotivationValuesAndPurposesSeeder;
use Database\Seeders\BaseTests\OrganizationalQuestions\WorkConditionsSeeder;
use Database\Seeders\BaseTests\OrganizationalQuestions\WorkSocialRelationsSeeder;
use Database\Seeders\BaseTests\PsychosocialQuestions\EmploymentConditionsSeeder;
use Database\Seeders\BaseTests\PsychosocialQuestions\InterpersonalRelationsSeeder;
use Database\Seeders\BaseTests\PsychosocialQuestions\ManagementStyleSeeder;
use Database\Seeders\BaseTests\PsychosocialQuestions\WorkContentSeeder;
use Database\Seeders\BaseTests\PsychosocialQuestions\WorkOrganizationSeeder;
use Database\Seeders\BaseTests\PsychosocialQuestions\WorkRelatedDisordersSeeder;
use Illuminate\Database\Seeder;

class BaseCollectionsSeeder extends Seeder
{
    public function run(): void
    {
        BaseCollection::insert([
            [
                'name' => 'Riscos Psicossociais',
                'type' => BaseCollectionTypes::PSYCHOSOCIAL->value
            ],
            [
                'name' => 'Clima Organizacional',
                'type' => BaseCollectionTypes::ORGANIZATIONAL->value
            ],
        ]);

        $this->call([
            // Psychosocial
            WorkOrganizationSeeder::class,
            ManagementStyleSeeder::class,
            InterpersonalRelationsSeeder::class,
            WorkContentSeeder::class,
            EmploymentConditionsSeeder::class,
            WorkRelatedDisordersSeeder::class,

            // Organizational
            WorkConditionsSeeder::class,
            WorkSocialRelationsSeeder::class,
            MotivationValuesAndPurposesSeeder::class,
            DevelopmentCarreerRecognitionSeeder::class,
            CommunicationAndInformationSeeder::class,
            EngagementAndPrideSeeder::class,
        ]);
    }
}
