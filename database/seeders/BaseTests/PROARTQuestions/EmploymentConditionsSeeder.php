<?php

namespace Database\Seeders\BaseTests\PROARTQuestions;

use App\Enums\PROART\PROARTGroup;
use App\Models\BaseQuestion;
use Illuminate\Database\Seeder;

class EmploymentConditionsSeeder extends Seeder
{
    public function run(): void
    {
        BaseQuestion::insert([
            [
                'base_collection_id' => 1,
                'statement' => 'Permaneço neste emprego por falta de oportunidade no mercado de trabalho?',
                'inverted' => false,
                'group' => PROARTGroup::EMPLOYMENT_CONDITIONS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'As pessoas são compromissadas com a organização mesmo quando não há retorno adequado?',
                'inverted' => false,
                'group' => PROARTGroup::EMPLOYMENT_CONDITIONS
            ],
        ]);
    }
}