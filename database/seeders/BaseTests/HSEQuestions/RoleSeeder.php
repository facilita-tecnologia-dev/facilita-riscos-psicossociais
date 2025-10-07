<?php

namespace Database\Seeders\BaseTests\HSEQuestions;

use App\Enums\HSE\HSEGroup;
use App\Models\BaseQuestion;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        BaseQuestion::insert([
            [
                'base_collection_id' => 2,
                'statement' => 'Sei claramente o que é esperado de mim no trabalho.',
                'inverted' => false,
                'group' => HSEGroup::ROLE
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Sei como fazer para executar o meu trabalho.',
                'inverted' => false,
                'group' => HSEGroup::ROLE
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Estou ciente de quais são os meus deveres e responsabilidades.',
                'inverted' => false,
                'group' => HSEGroup::ROLE
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Eu conheço as metas e objetivos do meu setor.',
                'inverted' => false,
                'group' => HSEGroup::ROLE
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Compreendo como o meu trabalho se integra com os objetivos da empresa.',
                'inverted' => false,
                'group' => HSEGroup::ROLE
            ],
        ]);
    }
}