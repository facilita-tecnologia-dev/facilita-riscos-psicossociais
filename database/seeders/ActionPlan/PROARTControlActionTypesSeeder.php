<?php

namespace Database\Seeders\ActionPlan;

use App\Enums\Psychosocial\PROART\PROARTControlActionTypes;
use App\Models\ControlActionType;
use Illuminate\Database\Seeder;

class PROARTControlActionTypesSeeder extends Seeder
{
    public function run(): void
    {
        ControlActionType::insert([
            [
                'type' => PROARTControlActionTypes::REDUCTION->value,
                'display_name' => PROARTControlActionTypes::REDUCTION->label(),
            ],
            [
                'type' => PROARTControlActionTypes::ADMINISTRATIVE->value,
                'display_name' => PROARTControlActionTypes::ADMINISTRATIVE->label(),
            ],
            [
                'type' => PROARTControlActionTypes::PROTECTION->value,
                'display_name' => PROARTControlActionTypes::PROTECTION->label(),
            ],
            [
                'type' => PROARTControlActionTypes::PREVENTION->value,
                'display_name' => PROARTControlActionTypes::PREVENTION->label(),
            ]
        ]);
    }
}
