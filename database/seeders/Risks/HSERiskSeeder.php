<?php

namespace Database\Seeders\Risks;

use App\Enums\HSE\HSEHazard;
use App\Enums\HSE\HSEGroup;
use App\Enums\HSE\HSEGravity;
use App\Models\Hazard;
use Illuminate\Database\Seeder;

class HSERiskSeeder extends Seeder
{
    public function run(): void
    {
        Hazard::insert([
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::WORK_OVERLOAD->label(),
                'type' => HSEHazard::WORK_OVERLOAD->value,
                'gravity' => HSEGravity::MODERATE->value,
                'group' => HSEGroup::DEMANDS
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::DEADLINE_PRESSURE->label(),
                'type' => HSEHazard::DEADLINE_PRESSURE->value,
                'gravity' => HSEGravity::MODERATE->value,
                'group' => HSEGroup::DEMANDS
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::LONG_WORKING_HOURS->label(),
                'type' => HSEHazard::LONG_WORKING_HOURS->value,
                'gravity' => HSEGravity::MODERATE->value,
                'group' => HSEGroup::DEMANDS
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::CONSTANT_INTERRUPTIONS->label(),
                'type' => HSEHazard::CONSTANT_INTERRUPTIONS->value,
                'gravity' => HSEGravity::LOW->value,
                'group' => HSEGroup::DEMANDS
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::INSUFFICIENT_RESOURCES->label(),
                'type' => HSEHazard::INSUFFICIENT_RESOURCES->value,
                'gravity' => HSEGravity::MODERATE->value,
                'group' => HSEGroup::DEMANDS
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::HIGH_EMOTIONAL_DEMANDS->label(),
                'type' => HSEHazard::HIGH_EMOTIONAL_DEMANDS->value,
                'gravity' => HSEGravity::MODERATE->value,
                'group' => HSEGroup::DEMANDS
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::LOW_AUTONOMY->label(),
                'type' => HSEHazard::LOW_AUTONOMY->value,
                'gravity' => HSEGravity::LOW->value,
                'group' => HSEGroup::CONTROL
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::MICROMANAGEMENT->label(),
                'type' => HSEHazard::MICROMANAGEMENT->value,
                'gravity' => HSEGravity::MODERATE->value,
                'group' => HSEGroup::CONTROL
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::LOW_SCHEDULE_FLEXIBILITY->label(),
                'type' => HSEHazard::LOW_SCHEDULE_FLEXIBILITY->value,
                'gravity' => HSEGravity::LOW->value,
                'group' => HSEGroup::CONTROL
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::RIGID_PROCEDURES->label(),
                'type' => HSEHazard::RIGID_PROCEDURES->value,
                'gravity' => HSEGravity::LOW->value,
                'group' => HSEGroup::CONTROL
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::LACK_OF_FEEDBACK->label(),
                'type' => HSEHazard::LACK_OF_FEEDBACK->value,
                'gravity' => HSEGravity::LOW->value,
                'group' => HSEGroup::SUPPORT
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::TOXIC_LEADERSHIP->label(),
                'type' => HSEHazard::TOXIC_LEADERSHIP->value,
                'gravity' => HSEGravity::MODERATE->value,
                'group' => HSEGroup::SUPPORT
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::INSUFFICIENT_TRAINING->label(),
                'type' => HSEHazard::INSUFFICIENT_TRAINING->value,
                'gravity' => HSEGravity::LOW->value,
                'group' => HSEGroup::SUPPORT
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::SOCIAL_ISOLATION->label(),
                'type' => HSEHazard::SOCIAL_ISOLATION->value,
                'gravity' => HSEGravity::LOW->value,
                'group' => HSEGroup::SUPPORT
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::CHRONIC_TEAM_CONFLICTS->label(),
                'type' => HSEHazard::CHRONIC_TEAM_CONFLICTS->value,
                'gravity' => HSEGravity::MODERATE->value,
                'group' => HSEGroup::RELATIONSHIPS
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::MORAL_HARASSMENT->label(),
                'type' => HSEHazard::MORAL_HARASSMENT->value,
                'gravity' => HSEGravity::HIGH->value,
                'group' => HSEGroup::RELATIONSHIPS
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::SEXUAL_HARASSMENT->label(),
                'type' => HSEHazard::SEXUAL_HARASSMENT->value,
                'gravity' => HSEGravity::EXTREME->value,
                'group' => HSEGroup::RELATIONSHIPS
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::INCIVILITY->label(),
                'type' => HSEHazard::INCIVILITY->value,
                'gravity' => HSEGravity::MODERATE->value,
                'group' => HSEGroup::RELATIONSHIPS
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::DISCRIMINATION->label(),
                'type' => HSEHazard::DISCRIMINATION->value,
                'gravity' => HSEGravity::HIGH->value,
                'group' => HSEGroup::RELATIONSHIPS
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::VIOLENCE->label(),
                'type' => HSEHazard::VIOLENCE->value,
                'gravity' => HSEGravity::EXTREME->value,
                'group' => HSEGroup::RELATIONSHIPS
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::ROLE_AMBIGUITY->label(),
                'type' => HSEHazard::ROLE_AMBIGUITY->value,
                'gravity' => HSEGravity::LOW->value,
                'group' => HSEGroup::ROLE
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::ROLE_CONFLICT->label(),
                'type' => HSEHazard::ROLE_CONFLICT->value,
                'gravity' => HSEGravity::MODERATE->value,
                'group' => HSEGroup::ROLE
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::RESPONSIBILITY_WITHOUT_AUTHORITY->label(),
                'type' => HSEHazard::RESPONSIBILITY_WITHOUT_AUTHORITY->value,
                'gravity' => HSEGravity::MODERATE->value,
                'group' => HSEGroup::ROLE
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::FREQUENT_PRIORITY_CHANGES->label(),
                'type' => HSEHazard::FREQUENT_PRIORITY_CHANGES->value,
                'gravity' => HSEGravity::LOW->value,
                'group' => HSEGroup::ROLE
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::POOR_CHANGE_COMMUNICATION->label(),
                'type' => HSEHazard::POOR_CHANGE_COMMUNICATION->value,
                'gravity' => HSEGravity::LOW->value,
                'group' => HSEGroup::CHANGE
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::JOB_INSECURITY->label(),
                'type' => HSEHazard::JOB_INSECURITY->value,
                'gravity' => HSEGravity::MODERATE->value,
                'group' => HSEGroup::CHANGE
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::RESTRUCTURING->label(),
                'type' => HSEHazard::RESTRUCTURING->value,
                'gravity' => HSEGravity::MODERATE->value,
                'group' => HSEGroup::CHANGE
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::NEW_TECHNOLOGY_WITHOUT_TRAINING->label(),
                'type' => HSEHazard::NEW_TECHNOLOGY_WITHOUT_TRAINING->value,
                'gravity' => HSEGravity::LOW->value,
                'group' => HSEGroup::CHANGE
            ],
            [
                'base_collection_id' => 2,
                'name' => HSEHazard::LOSS_OF_BENEFITS->label(),
                'type' => HSEHazard::LOSS_OF_BENEFITS->value,
                'gravity' => HSEGravity::MODERATE->value,
                'group' => HSEGroup::CHANGE
            ],
        ]);
    }
}
