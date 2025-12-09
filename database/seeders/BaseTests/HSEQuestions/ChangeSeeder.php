<?php

namespace Database\Seeders\BaseTests\HSEQuestions;

use App\Enums\Psychosocial\HSE\HSEGroup;
use App\Models\BaseQuestion;
use Illuminate\Database\Seeder;

class ChangeSeeder extends Seeder
{
    public function run(): void
    {
        BaseQuestion::insert([
            [
                'base_collection_id' => 2,
                'statement' => 'Tenho oportunidades suficientes para questionar as chefias sobre mudanças no trabalho?',
                'inverted' => false,
                'group' => HSEGroup::CHANGE
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'A equipe é sempre consultada sobre mudanças no trabalho?',
                'inverted' => false,
                'group' => HSEGroup::CHANGE
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Quando ocorrem mudanças no trabalho, sou esclarecido de como elas funcionarão na prática?',
                'inverted' => false,
                'group' => HSEGroup::CHANGE
            ],
        ]);
    }
}