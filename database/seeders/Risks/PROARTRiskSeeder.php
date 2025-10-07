<?php

namespace Database\Seeders\Risks;

use App\Enums\PROART\PROARTGravity;
use App\Enums\PROART\PROARTGroup;
use App\Enums\PROART\PROARTHazard;
use App\Models\Hazard;
use Illuminate\Database\Seeder;

class PROARTRiskSeeder extends Seeder
{
    public function run(): void
    {
        Hazard::insert([
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::ORGANIZATIONAL_RIGIDITY->label(),
                'type' => PROARTHazard::ORGANIZATIONAL_RIGIDITY->value,
                'gravity' => PROARTGravity::MEDIUM->value,
                'group' => PROARTGroup::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::WORK_OVERLOAD->label(),
                'type' => PROARTHazard::WORK_OVERLOAD->value,
                'gravity' => PROARTGravity::HIGH->value,
                'group' => PROARTGroup::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::LACK_OF_RESOURCES->label(),
                'type' => PROARTHazard::LACK_OF_RESOURCES->value,
                'gravity' => PROARTGravity::MEDIUM->value,
                'group' => PROARTGroup::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::UNPREDICTABILITY->label(),
                'type' => PROARTHazard::UNPREDICTABILITY->value,
                'gravity' => PROARTGravity::MEDIUM->value,
                'group' => PROARTGroup::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::MONOTONY->label(),
                'type' => PROARTHazard::MONOTONY->value,
                'gravity' => PROARTGravity::LOW->value,
                'group' => PROARTGroup::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::ROLE_CONFLICT->label(),
                'type' => PROARTHazard::ROLE_CONFLICT->value,
                'gravity' => PROARTGravity::MEDIUM->value,
                'group' => PROARTGroup::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::INDIVIDUALISTIC_MANAGEMENT->label(),
                'type' => PROARTHazard::INDIVIDUALISTIC_MANAGEMENT->value,
                'gravity' => PROARTGravity::MEDIUM->value,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::LACK_OF_RECOGNITION->label(),
                'type' => PROARTHazard::LACK_OF_RECOGNITION->value,
                'gravity' => PROARTGravity::LOW->value,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::MANAGEMENT_CONFLICTS->label(),
                'type' => PROARTHazard::MANAGEMENT_CONFLICTS->value,
                'gravity' => PROARTGravity::MEDIUM->value,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::LACK_OF_MANAGERIAL_SUPPORT->label(),
                'type' => PROARTHazard::LACK_OF_MANAGERIAL_SUPPORT->value,
                'gravity' => PROARTGravity::MEDIUM->value,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::PERCEIVED_INJUSTICE->label(),
                'type' => PROARTHazard::PERCEIVED_INJUSTICE->value,
                'gravity' => PROARTGravity::MEDIUM->value,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::EXCESSIVE_MANAGEMENT_PRESSURE->label(),
                'type' => PROARTHazard::EXCESSIVE_MANAGEMENT_PRESSURE->value,
                'gravity' => PROARTGravity::HIGH->value,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::EMOTIONAL_EXHAUSTION->label(),
                'type' => PROARTHazard::EMOTIONAL_EXHAUSTION->value,
                'gravity' => PROARTGravity::HIGH->value,
                'group' => PROARTGroup::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::ANXIETY_OR_STRESS->label(),
                'type' => PROARTHazard::ANXIETY_OR_STRESS->value,
                'gravity' => PROARTGravity::HIGH->value,
                'group' => PROARTGroup::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::SOCIAL_ISOLATION->label(),
                'type' => PROARTHazard::SOCIAL_ISOLATION->value,
                'gravity' => PROARTGravity::MEDIUM->value,
                'group' => PROARTGroup::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::FRUSTRATION_OR_DEMOTIVATION->label(),
                'type' => PROARTHazard::FRUSTRATION_OR_DEMOTIVATION->value,
                'gravity' => PROARTGravity::MEDIUM->value,
                'group' => PROARTGroup::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::IRRITABILITY->label(),
                'type' => PROARTHazard::IRRITABILITY->value,
                'gravity' => PROARTGravity::MEDIUM->value,
                'group' => PROARTGroup::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::DIFFICULTY_CONCENTRATING->label(),
                'type' => PROARTHazard::DIFFICULTY_CONCENTRATING->value,
                'gravity' => PROARTGravity::MEDIUM->value,
                'group' => PROARTGroup::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::PHYSICAL_DAMAGE->label(),
                'type' => PROARTHazard::PHYSICAL_DAMAGE->value,
                'gravity' => PROARTGravity::HIGH->value,
                'group' => PROARTGroup::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::PSYCHOLOGICAL_DAMAGE->label(),
                'type' => PROARTHazard::PSYCHOLOGICAL_DAMAGE->value,
                'gravity' => PROARTGravity::CRITICAL->value,
                'group' => PROARTGroup::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::FREQUENT_ABSENTEEISM->label(),
                'type' => PROARTHazard::FREQUENT_ABSENTEEISM->value,
                'gravity' => PROARTGravity::HIGH->value,
                'group' => PROARTGroup::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::SLEEP_DISORDERS->label(),
                'type' => PROARTHazard::SLEEP_DISORDERS->value,
                'gravity' => PROARTGravity::HIGH->value,
                'group' => PROARTGroup::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::PSYCHOSOMATIC_PROBLEMS->label(),
                'type' => PROARTHazard::PSYCHOSOMATIC_PROBLEMS->value,
                'gravity' => PROARTGravity::HIGH->value,
                'group' => PROARTGroup::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::DETERIORATION_OF_PERSONAL_LIFE->label(),
                'type' => PROARTHazard::DETERIORATION_OF_PERSONAL_LIFE->value,
                'gravity' => PROARTGravity::HIGH->value,
                'group' => PROARTGroup::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::MORAL_HARASSMENT->label(),
                'type' => PROARTHazard::MORAL_HARASSMENT->value,
                'gravity' => PROARTGravity::HIGH->value,
                'group' => PROARTGroup::WORK_RELATED_DISORDERS
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::SEXUAL_HARASSMENT->label(),
                'type' => PROARTHazard::SEXUAL_HARASSMENT->value,
                'gravity' => PROARTGravity::CRITICAL->value,
                'group' => PROARTGroup::WORK_RELATED_DISORDERS
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::DISCRIMINATION->label(),
                'type' => PROARTHazard::DISCRIMINATION->value,
                'gravity' => PROARTGravity::MEDIUM->value,
                'group' => PROARTGroup::WORK_RELATED_DISORDERS
            ],
            [
                'base_collection_id' => 1,
                'name' => PROARTHazard::OTHER_FORMS_OF_VIOLENCE->label(),
                'type' => PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value,
                'gravity' => PROARTGravity::CRITICAL->value,
                'group' => PROARTGroup::WORK_RELATED_DISORDERS
            ],
        ]);

        $this->call([
            PROARTQuestionHazardSeeder::class,
        ]);
    }
}
