<?php

namespace Database\Seeders\BaseTests;

use App\Enums\BaseCollectionType;
use App\Models\BaseCollection;
use App\Enums\BaseCollection as EnumBaseCollection;
use Database\Seeders\BaseTests\HSEQuestions\ChangeSeeder;
use Database\Seeders\BaseTests\HSEQuestions\ControlSeeder;
use Database\Seeders\BaseTests\HSEQuestions\DemandsSeeder;
use Database\Seeders\BaseTests\HSEQuestions\RelationshipsSeeder;
use Database\Seeders\BaseTests\HSEQuestions\RoleSeeder;
use Database\Seeders\BaseTests\HSEQuestions\SupportSeeder;
use Database\Seeders\BaseTests\OrganizationalQuestions\CommunicationAndInformationSeeder;
use Database\Seeders\BaseTests\OrganizationalQuestions\DevelopmentCarreerRecognitionSeeder;
use Database\Seeders\BaseTests\OrganizationalQuestions\EngagementAndPrideSeeder;
use Database\Seeders\BaseTests\OrganizationalQuestions\MotivationValuesAndPurposesSeeder;
use Database\Seeders\BaseTests\OrganizationalQuestions\WorkConditionsSeeder;
use Database\Seeders\BaseTests\OrganizationalQuestions\WorkSocialRelationsSeeder;
use Database\Seeders\BaseTests\PROARTQuestions\EmploymentConditionsSeeder;
use Database\Seeders\BaseTests\PROARTQuestions\InterpersonalRelationsSeeder;
use Database\Seeders\BaseTests\PROARTQuestions\ManagementStyleSeeder;
use Database\Seeders\BaseTests\PROARTQuestions\WorkContentSeeder;
use Database\Seeders\BaseTests\PROARTQuestions\WorkOrganizationSeeder;
use Database\Seeders\BaseTests\PROARTQuestions\WorkRelatedDisordersSeeder;
use Illuminate\Database\Seeder;

class BaseCollectionsSeeder extends Seeder
{
    public function run(): void
    {
        BaseCollection::insert([
            [
                'name' => 'Riscos Psicossociais',
                'key' => EnumBaseCollection::PROART->value,
                'type' => BaseCollectionType::PSYCHOSOCIAL->value
            ],
            [
                'name' => 'Riscos Psicossociais',
                'key' => EnumBaseCollection::HSE->value,
                'type' => BaseCollectionType::PSYCHOSOCIAL->value
            ],
            [
                'name' => 'Clima Organizacional',
                'key' => EnumBaseCollection::ORGANIZATIONAL->value,
                'type' => BaseCollectionType::ORGANIZATIONAL->value
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

            // HSE
            DemandsSeeder::class,
            ControlSeeder::class,
            SupportSeeder::class,
            RelationshipsSeeder::class,
            RoleSeeder::class,
            ChangeSeeder::class,
            

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
