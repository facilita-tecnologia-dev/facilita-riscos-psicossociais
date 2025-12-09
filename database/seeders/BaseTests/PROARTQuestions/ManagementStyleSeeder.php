<?php

namespace Database\Seeders\BaseTests\PROARTQuestions;

use App\Enums\Psychosocial\PROART\PROARTGroup;
use App\Models\BaseQuestion;
use Illuminate\Database\Seeder;

class ManagementStyleSeeder extends Seeder
{
    public function run(): void
    {
        BaseQuestion::insert([
            [
                'base_collection_id' => 1,
                'statement' => 'A comunicação entre chefe e subordinado é adequada?',
                'inverted' => true,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Os funcionários participam das decisões sobre o trabalho?',
                'inverted' => true,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'A avaliação do meu trabalho inclui aspectos além da minha produção?',
                'inverted' => true,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Os gestores se preocupam com o bem-estar dos trabalhadores?',
                'inverted' => true,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'A competência dos trabalhadores é valorizada pela gestão?',
                'inverted' => true,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Os gestores favorecem o trabalho interativo de profissionais de diferentes áreas?',
                'inverted' => true,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Somos incentivados pelos gestores a buscar novos desafios?',
                'inverted' => true,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'As decisões nesta organização são tomadas em grupo?',
                'inverted' => true,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Para esta organização, o resultado do trabalho é visto como uma realização do grupo?',
                'inverted' => true,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'O trabalho coletivo é valorizado pelos gestores?',
                'inverted' => true,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'O mérito das conquistas na empresa é de todos?',
                'inverted' => true,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'A hierarquia é valorizada nesta organização?',
                'inverted' => false,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'É creditada grande importância para as regras nesta organização?',
                'inverted' => false,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Os gestores preferem trabalhar individualmente?',
                'inverted' => false,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Os gestores desta organização se consideram insubstituíveis?',
                'inverted' => false,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Meu chefe ou colegas me humilham publicamente?',
                'inverted' => false,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Recebo críticas constantes e injustas sobre meu desempenho?',
                'inverted' => false,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Sou tratado(a) de forma diferente por motivos de raça, gênero, orientação sexual ou deficiência?',
                'inverted' => false,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Alguns colegas recebem vantagens sem mérito, baseadas em preconceitos?',
                'inverted' => false,
                'group' => PROARTGroup::MANAGEMENT_STYLE
            ],
        ]);
    }
}