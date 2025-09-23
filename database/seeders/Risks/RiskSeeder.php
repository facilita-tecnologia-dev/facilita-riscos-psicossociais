<?php

namespace Database\Seeders\Risks;

use App\Enums\CollectionFactorTypes;
use App\Enums\GravityTypes;
use App\Enums\RiskTypes;
use App\Models\Risk;
use Illuminate\Database\Seeder;

class RiskSeeder extends Seeder
{
    public function run(): void
    {
        Risk::insert([
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::ORGANIZATIONAL_RIGIDITY->label(),
                'type' => RiskTypes::ORGANIZATIONAL_RIGIDITY->value,
                'gravity' => GravityTypes::MEDIUM->value,
                'group' => CollectionFactorTypes::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::WORK_OVERLOAD->label(),
                'type' => RiskTypes::WORK_OVERLOAD->value,
                'gravity' => GravityTypes::HIGH->value,
                'group' => CollectionFactorTypes::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::LACK_OF_RESOURCES->label(),
                'type' => RiskTypes::LACK_OF_RESOURCES->value,
                'gravity' => GravityTypes::MEDIUM->value,
                'group' => CollectionFactorTypes::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::UNPREDICTABILITY->label(),
                'type' => RiskTypes::UNPREDICTABILITY->value,
                'gravity' => GravityTypes::MEDIUM->value,
                'group' => CollectionFactorTypes::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::MONOTONY->label(),
                'type' => RiskTypes::MONOTONY->value,
                'gravity' => GravityTypes::LOW->value,
                'group' => CollectionFactorTypes::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::ROLE_CONFLICT->label(),
                'type' => RiskTypes::ROLE_CONFLICT->value,
                'gravity' => GravityTypes::MEDIUM->value,
                'group' => CollectionFactorTypes::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::INDIVIDUALISTIC_MANAGEMENT->label(),
                'type' => RiskTypes::INDIVIDUALISTIC_MANAGEMENT->value,
                'gravity' => GravityTypes::MEDIUM->value,
                'group' => CollectionFactorTypes::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::LACK_OF_RECOGNITION->label(),
                'type' => RiskTypes::LACK_OF_RECOGNITION->value,
                'gravity' => GravityTypes::LOW->value,
                'group' => CollectionFactorTypes::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::MANAGEMENT_CONFLICTS->label(),
                'type' => RiskTypes::MANAGEMENT_CONFLICTS->value,
                'gravity' => GravityTypes::MEDIUM->value,
                'group' => CollectionFactorTypes::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::LACK_OF_MANAGERIAL_SUPPORT->label(),
                'type' => RiskTypes::LACK_OF_MANAGERIAL_SUPPORT->value,
                'gravity' => GravityTypes::MEDIUM->value,
                'group' => CollectionFactorTypes::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::PERCEIVED_INJUSTICE->label(),
                'type' => RiskTypes::PERCEIVED_INJUSTICE->value,
                'gravity' => GravityTypes::MEDIUM->value,
                'group' => CollectionFactorTypes::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::EXCESSIVE_MANAGEMENT_PRESSURE->label(),
                'type' => RiskTypes::EXCESSIVE_MANAGEMENT_PRESSURE->value,
                'gravity' => GravityTypes::HIGH->value,
                'group' => CollectionFactorTypes::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::EMOTIONAL_EXHAUSTION->label(),
                'type' => RiskTypes::EMOTIONAL_EXHAUSTION->value,
                'gravity' => GravityTypes::HIGH->value,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::ANXIETY_OR_STRESS->label(),
                'type' => RiskTypes::ANXIETY_OR_STRESS->value,
                'gravity' => GravityTypes::HIGH->value,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::SOCIAL_ISOLATION->label(),
                'type' => RiskTypes::SOCIAL_ISOLATION->value,
                'gravity' => GravityTypes::MEDIUM->value,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::FRUSTRATION_OR_DEMOTIVATION->label(),
                'type' => RiskTypes::FRUSTRATION_OR_DEMOTIVATION->value,
                'gravity' => GravityTypes::MEDIUM->value,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::IRRITABILITY->label(),
                'type' => RiskTypes::IRRITABILITY->value,
                'gravity' => GravityTypes::MEDIUM->value,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::DIFFICULTY_CONCENTRATING->label(),
                'type' => RiskTypes::DIFFICULTY_CONCENTRATING->value,
                'gravity' => GravityTypes::MEDIUM->value,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::PHYSICAL_DAMAGE->label(),
                'type' => RiskTypes::PHYSICAL_DAMAGE->value,
                'gravity' => GravityTypes::HIGH->value,
                'group' => CollectionFactorTypes::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::PSYCHOLOGICAL_DAMAGE->label(),
                'type' => RiskTypes::PSYCHOLOGICAL_DAMAGE->value,
                'gravity' => GravityTypes::CRITICAL->value,
                'group' => CollectionFactorTypes::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::FREQUENT_ABSENTEEISM->label(),
                'type' => RiskTypes::FREQUENT_ABSENTEEISM->value,
                'gravity' => GravityTypes::HIGH->value,
                'group' => CollectionFactorTypes::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::SLEEP_DISORDERS->label(),
                'type' => RiskTypes::SLEEP_DISORDERS->value,
                'gravity' => GravityTypes::HIGH->value,
                'group' => CollectionFactorTypes::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::PSYCHOSOMATIC_PROBLEMS->label(),
                'type' => RiskTypes::PSYCHOSOMATIC_PROBLEMS->value,
                'gravity' => GravityTypes::HIGH->value,
                'group' => CollectionFactorTypes::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::DETERIORATION_OF_PERSONAL_LIFE->label(),
                'type' => RiskTypes::DETERIORATION_OF_PERSONAL_LIFE->value,
                'gravity' => GravityTypes::HIGH->value,
                'group' => CollectionFactorTypes::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::MORAL_HARASSMENT->label(),
                'type' => RiskTypes::MORAL_HARASSMENT->value,
                'gravity' => GravityTypes::HIGH->value,
                'group' => CollectionFactorTypes::WORK_RELATED_DISORDERS
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::SEXUAL_HARASSMENT->label(),
                'type' => RiskTypes::SEXUAL_HARASSMENT->value,
                'gravity' => GravityTypes::CRITICAL->value,
                'group' => CollectionFactorTypes::WORK_RELATED_DISORDERS
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::DISCRIMINATION->label(),
                'type' => RiskTypes::DISCRIMINATION->value,
                'gravity' => GravityTypes::MEDIUM->value,
                'group' => CollectionFactorTypes::WORK_RELATED_DISORDERS
            ],
            [
                'base_collection_id' => 1,
                'name' => RiskTypes::OTHER_FORMS_OF_VIOLENCE->label(),
                'type' => RiskTypes::OTHER_FORMS_OF_VIOLENCE->value,
                'gravity' => GravityTypes::CRITICAL->value,
                'group' => CollectionFactorTypes::WORK_RELATED_DISORDERS
            ],
        ]);

        $this->call([
            QuestionRiskSeeder::class,
        ]);
    }
}
