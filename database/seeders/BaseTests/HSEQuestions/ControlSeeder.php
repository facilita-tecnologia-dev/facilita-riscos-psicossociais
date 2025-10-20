<?php

namespace Database\Seeders\BaseTests\HSEQuestions;

use App\Enums\HSE\HSEGroup;
use App\Models\BaseQuestion;
use Illuminate\Database\Seeder;

class ControlSeeder extends Seeder
{
    public function run(): void
    {
        BaseQuestion::insert([
            [
                'base_collection_id' => 2,
                'statement' => 'Posso decidir quando fazer uma pausa?',
                'inverted' => false,
                'group' => HSEGroup::CONTROL
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Posso decidir sobre meu ritmo de trabalho?',
                'inverted' => false,
                'group' => HSEGroup::CONTROL
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Posso escolher como fazer meu trabalho?',
                'inverted' => false,
                'group' => HSEGroup::CONTROL
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Posso escolher o que fazer no trabalho?',
                'inverted' => false,
                'group' => HSEGroup::CONTROL
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Tenho algum poder de decisão sobre a minha maneira de trabalhar?',
                'inverted' => false,
                'group' => HSEGroup::CONTROL
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Meu horário de trabalho pode ser flexível?',
                'inverted' => false,
                'group' => HSEGroup::CONTROL
            ],
        ]);
    }
}