<?php

namespace Database\Seeders\CIDS;

use App\Enums\HSE\HSECID;
use App\Enums\HSE\HSEHazard;
use App\Models\CID;
use App\Models\Hazard;
use App\Models\HazardCID;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HazardCIDSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hazards = Hazard::where('base_collection_id', 2)->get();
        $cids = CID::all();

        HazardCID::insert([
            // work-overload
            [
                'hazard_id' => $hazards->where('type', HSEHazard::WORK_OVERLOAD->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F32)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::WORK_OVERLOAD->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F33)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::WORK_OVERLOAD->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_8)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::WORK_OVERLOAD->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::Z73_0)->first()->id,
            ],

            // deadline-pressure
            [
                'hazard_id' => $hazards->where('type', HSEHazard::DEADLINE_PRESSURE->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F32)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::DEADLINE_PRESSURE->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F33)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::DEADLINE_PRESSURE->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_8)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::DEADLINE_PRESSURE->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::Z73_0)->first()->id,
            ],

            // long-working-hours
            [
                'hazard_id' => $hazards->where('type', HSEHazard::LONG_WORKING_HOURS->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F41)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::LONG_WORKING_HOURS->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_2)->first()->id,
            ],

            // constant-interruptions
            [
                'hazard_id' => $hazards->where('type', HSEHazard::CONSTANT_INTERRUPTIONS->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F32)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::CONSTANT_INTERRUPTIONS->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F34)->first()->id,
            ],

            // insufficient-resources
            [
                'hazard_id' => $hazards->where('type', HSEHazard::INSUFFICIENT_RESOURCES->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F41)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::INSUFFICIENT_RESOURCES->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_2)->first()->id,
            ],

            // high-emotional-demands
            [
                'hazard_id' => $hazards->where('type', HSEHazard::HIGH_EMOTIONAL_DEMANDS->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F32)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::HIGH_EMOTIONAL_DEMANDS->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F33)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::HIGH_EMOTIONAL_DEMANDS->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_8)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::HIGH_EMOTIONAL_DEMANDS->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::Z73_0)->first()->id,
            ],

            // low-autonomy
            [
                'hazard_id' => $hazards->where('type', HSEHazard::LOW_AUTONOMY->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F32)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::LOW_AUTONOMY->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_2)->first()->id,
            ],

            // micromanagement
            [
                'hazard_id' => $hazards->where('type', HSEHazard::MICROMANAGEMENT->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F41)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::MICROMANAGEMENT->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_2)->first()->id,
            ],

            // low-schedule-flexibility
            [
                'hazard_id' => $hazards->where('type', HSEHazard::LOW_SCHEDULE_FLEXIBILITY->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_1)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::LOW_SCHEDULE_FLEXIBILITY->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_2)->first()->id,
            ],

            // rigid-procedures
            [
                'hazard_id' => $hazards->where('type', HSEHazard::RIGID_PROCEDURES->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F32)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::RIGID_PROCEDURES->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_2)->first()->id,
            ],

            // lack-of-feedback
            [
                'hazard_id' => $hazards->where('type', HSEHazard::LACK_OF_FEEDBACK->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F32)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::LACK_OF_FEEDBACK->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F33)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::LACK_OF_FEEDBACK->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F34)->first()->id,
            ],

            // toxic-leadership
            [
                'hazard_id' => $hazards->where('type', HSEHazard::TOXIC_LEADERSHIP->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F32)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::TOXIC_LEADERSHIP->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F41)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::TOXIC_LEADERSHIP->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_2)->first()->id,
            ],

            // insufficient-training
            [
                'hazard_id' => $hazards->where('type', HSEHazard::INSUFFICIENT_TRAINING->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F41)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::INSUFFICIENT_TRAINING->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_2)->first()->id,
            ],

            // social-isolation
            [
                'hazard_id' => $hazards->where('type', HSEHazard::SOCIAL_ISOLATION->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F32)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::SOCIAL_ISOLATION->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F41)->first()->id,
            ],

            // chronic-team-conflicts
            [
                'hazard_id' => $hazards->where('type', HSEHazard::CHRONIC_TEAM_CONFLICTS->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F41)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::CHRONIC_TEAM_CONFLICTS->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_2)->first()->id,
            ],

            // moral-harassment
            [
                'hazard_id' => $hazards->where('type', HSEHazard::MORAL_HARASSMENT->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F32)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::MORAL_HARASSMENT->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F33)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::MORAL_HARASSMENT->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_8)->first()->id,
            ],

            // sexual-harassment
            [
                'hazard_id' => $hazards->where('type', HSEHazard::SEXUAL_HARASSMENT->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_1)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::SEXUAL_HARASSMENT->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_8)->first()->id,
            ],

            // incivility
            [
                'hazard_id' => $hazards->where('type', HSEHazard::INCIVILITY->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F41)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::INCIVILITY->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_2)->first()->id,
            ],

            // discrimination
            [
                'hazard_id' => $hazards->where('type', HSEHazard::DISCRIMINATION->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F32)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::DISCRIMINATION->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F41)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::DISCRIMINATION->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_2)->first()->id,
            ],

            // violence
            [
                'hazard_id' => $hazards->where('type', HSEHazard::VIOLENCE->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_1)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::VIOLENCE->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_8)->first()->id,
            ],

            // role-ambiguity
            [
                'hazard_id' => $hazards->where('type', HSEHazard::ROLE_AMBIGUITY->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F41)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::ROLE_AMBIGUITY->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_2)->first()->id,
            ],

            // role-conflict
            [
                'hazard_id' => $hazards->where('type', HSEHazard::ROLE_CONFLICT->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F41)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::ROLE_CONFLICT->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_2)->first()->id,
            ],

            // responsibility-without-authority
            [
                'hazard_id' => $hazards->where('type', HSEHazard::RESPONSIBILITY_WITHOUT_AUTHORITY->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F32)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::RESPONSIBILITY_WITHOUT_AUTHORITY->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_2)->first()->id,
            ],

            // frequent-priority-changes
            [
                'hazard_id' => $hazards->where('type', HSEHazard::FREQUENT_PRIORITY_CHANGES->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F41)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::FREQUENT_PRIORITY_CHANGES->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_2)->first()->id,
            ],

            // poor-change-communication
            [
                'hazard_id' => $hazards->where('type', HSEHazard::POOR_CHANGE_COMMUNICATION->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F41)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::POOR_CHANGE_COMMUNICATION->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_2)->first()->id,
            ],

            // job-insecurity
            [
                'hazard_id' => $hazards->where('type', HSEHazard::JOB_INSECURITY->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_0)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::JOB_INSECURITY->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_1)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::JOB_INSECURITY->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_2)->first()->id,
            ],

            // restructuring
            [
                'hazard_id' => $hazards->where('type', HSEHazard::RESTRUCTURING->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_0)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::RESTRUCTURING->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_1)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::RESTRUCTURING->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_2)->first()->id,
            ],

            // new-technology-without-training
            [
                'hazard_id' => $hazards->where('type', HSEHazard::NEW_TECHNOLOGY_WITHOUT_TRAINING->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F41)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::NEW_TECHNOLOGY_WITHOUT_TRAINING->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_2)->first()->id,
            ],

            // loss-of-benefits
            [
                'hazard_id' => $hazards->where('type', HSEHazard::LOSS_OF_BENEFITS->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_0)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::LOSS_OF_BENEFITS->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_1)->first()->id,
            ],
            [
                'hazard_id' => $hazards->where('type', HSEHazard::LOSS_OF_BENEFITS->value)->first()->id,
                'cid_id' => $cids->where('type', HSECID::F43_2)->first()->id,
            ],
        ]);
    }
}
