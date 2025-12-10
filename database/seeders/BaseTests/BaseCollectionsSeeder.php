<?php

namespace Database\Seeders\BaseTests;

use App\Enums\Campaign\CollectionType;
use App\Models\BaseCollection;
use App\Enums\Campaign\MetodologyType;
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
                'key' => MetodologyType::PROART->value,
                'type' => CollectionType::PSYCHOSOCIAL->value
            ],
            [
                'name' => 'Riscos Psicossociais',
                'key' => MetodologyType::HSE->value,
                'type' => CollectionType::PSYCHOSOCIAL->value
            ],
            [
                'name' => 'Clima Organizacional',
                'key' => MetodologyType::ORGANIZATIONAL->value,
                'type' => CollectionType::ORGANIZATIONAL->value
            ],
        ]);

        $this->call([
            // PROART
            WorkOrganizationSeeder::class,
            ManagementStyleSeeder::class,
            InterpersonalRelationsSeeder::class,
            WorkContentSeeder::class,
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
