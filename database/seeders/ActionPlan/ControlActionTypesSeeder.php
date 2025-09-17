<?php

namespace Database\Seeders\ActionPlan;

use App\Enums\ControlActionTypes;
use App\Models\ControlActionType;
use Illuminate\Database\Seeder;

class ControlActionTypesSeeder extends Seeder
{
    public function run(): void
    {
        ControlActionType::insert([
            [
                'type' => ControlActionTypes::REDUCTION->value,
                'display_name' => ControlActionTypes::REDUCTION->label(),
            ],
            [
                'type' => ControlActionTypes::PROTECTION->value,
                'display_name' => ControlActionTypes::PROTECTION->label(),
            ],
            [
                'type' => ControlActionTypes::PREVENTION->value,
                'display_name' => ControlActionTypes::PREVENTION->label(),
            ],
            [
                'type' => ControlActionTypes::LEGISLATION->value,
                'display_name' => ControlActionTypes::LEGISLATION->label(),
            ]
        ]);
    }
}
