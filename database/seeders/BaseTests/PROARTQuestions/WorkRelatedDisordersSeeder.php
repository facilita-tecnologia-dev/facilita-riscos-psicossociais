<?php

namespace Database\Seeders\BaseTests\PROARTQuestions;

use App\Enums\Psychosocial\PROART\PROARTGroup;
use App\Models\BaseQuestion;
use Illuminate\Database\Seeder;

class WorkRelatedDisordersSeeder extends Seeder
{
    public function run(): void
    {
        BaseQuestion::insert([
            [
                'base_collection_id' => 1,
                'statement' => 'Alterações no apetite?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_RELATED_DISORDERS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Distúrbios circulatórios?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_RELATED_DISORDERS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Dores nas pernas?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_RELATED_DISORDERS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Alterações no sono?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_RELATED_DISORDERS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Dores nas costas?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_RELATED_DISORDERS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Distúrbios digestivos?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_RELATED_DISORDERS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Dor de cabeça?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_RELATED_DISORDERS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Dores no braço?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_RELATED_DISORDERS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Conflitos nas relações familiares?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_RELATED_DISORDERS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Dificuldade com os amigos?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_RELATED_DISORDERS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Meu trabalho é desgastante?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_RELATED_DISORDERS
            ],
        ]);
    }
}