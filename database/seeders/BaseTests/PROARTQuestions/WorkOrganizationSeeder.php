<?php

namespace Database\Seeders\BaseTests\PROARTQuestions;

use App\Enums\Psychosocial\PROART\PROARTGroup;
use App\Models\BaseQuestion;
use Illuminate\Database\Seeder;

class WorkOrganizationSeeder extends Seeder
{
    public function run(): void
    {
        BaseQuestion::insert([
            [
                'base_collection_id' => 1,
                'statement' => 'Tenho liberdade para opinar sobre o meu trabalho?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'As tarefas que executo em meu trabalho são variadas?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'As orientações para realizar as tarefas são coerentes entre si?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Há flexibilidade nas normas para a execução das tarefas?',
                'inverted' => true,
                'group' => PROARTGroup::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'As informações para executar minhas tarefas são claras?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Os prazos para a realização das tarefas são flexíveis?',
                'inverted' => true,
                'group' => PROARTGroup::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'O ritmo de trabalho é adequado?',
                'inverted' => true,
                'group' => PROARTGroup::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Os equipamentos são adequados para a realização das tarefas?',
                'inverted' => true,
                'group' => PROARTGroup::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'O espaço físico disponível para a realização do trabalho é adequado?',
                'inverted' => true,
                'group' => PROARTGroup::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Os recursos de trabalho são suficientes para a realização das tarefas?',
                'inverted' => true,
                'group' => PROARTGroup::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'O número de trabalhadores é suficiente para a execução das tarefas?',
                'inverted' => true,
                'group' => PROARTGroup::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'O ambiente de trabalho se desorganiza com mudanças?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Há forte controle do trabalho?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Meu trabalho me sobrecarrega?',
                'inverted' => false,
                'group' => PROARTGroup::WORK_ORGANIZATION
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Sou consultado(a) sobre mudanças no trabalho que me afetam?',
                'inverted' => true,
                'group' => PROARTGroup::WORK_ORGANIZATION
            ],
        ]);
    }

}