<?php

namespace Database\Seeders\BaseTests\PROARTQuestions;

use App\Enums\Psychosocial\PROART\PROARTGroup;
use App\Models\BaseQuestion;
use Illuminate\Database\Seeder;

class WorkContentSeeder extends Seeder
{
    public function run(): void
    {
        BaseQuestion::insert([
            [
                'base_collection_id' => 1,
                'statement' => 'Tenho autonomia para realizar as tarefas como julgo melhor?',
                'inverted' => true,
                'group' => PROARTGroup::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Minhas tarefas são banais?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Meu trabalho é sem sentido?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Meu trabalho é irrelevante para o desenvolvimento da sociedade?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'A identificação com minhas tarefas é inexistente?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Sinto-me improdutivo no meu trabalho?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'A inovação é valorizada nesta organização?',
                'inverted' => true,
                'group' => PROARTGroup::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Permaneço neste emprego por falta de oportunidade no mercado de trabalho?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'As pessoas são compromissadas com a organização mesmo quando não há retorno adequado?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_CONTENT
            ],
        ]);
    }
}