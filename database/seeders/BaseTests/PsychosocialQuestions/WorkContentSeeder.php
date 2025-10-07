<?php

namespace Database\Seeders\BaseTests\PsychosocialQuestions;

use App\Enums\PROART\PROARTGroup;
use App\Models\BaseQuestion;
use Illuminate\Database\Seeder;

class WorkContentSeeder extends Seeder
{
    public function run(): void
    {
        BaseQuestion::insert([
            [
                'base_collection_id' => 1,
                'statement' => 'Tenho autonomia para realizar as tarefas como julgo melhor.',
                'inverted' => true,
                'group' => PROARTGroup::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Minhas tarefas são banais.',
                'inverted' => false,
                'group' => PROARTGroup::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Meu trabalho é sem sentido.',
                'inverted' => false,
                'group' => PROARTGroup::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Meu trabalho é irrelevante para o desenvolvimento da sociedade.',
                'inverted' => false,
                'group' => PROARTGroup::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'A identificação com minhas tarefas é inexistente.',
                'inverted' => false,
                'group' => PROARTGroup::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Sinto-me improdutivo no meu trabalho.',
                'inverted' => false,
                'group' => PROARTGroup::WORK_CONTENT
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'A inovação é valorizada nesta organização.',
                'inverted' => true,
                'group' => PROARTGroup::WORK_CONTENT
            ],
        ]);
    }
}