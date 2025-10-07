<?php

namespace Database\Seeders\BaseTests\OrganizationalQuestions;

use App\Enums\OC\OCGroup;
use App\Models\BaseQuestion;
use Illuminate\Database\Seeder;

class MotivationValuesAndPurposesSeeder extends Seeder
{
    public function run(): void
    {
        BaseQuestion::insert([
            [
                'base_collection_id' => 3,
                'statement' => 'Vejo possibilidades de crescimento profissional.',
                'inverted' => false,
                'group' => OCGroup::MOTIVATION_VALUES_AND_PURPOSES
            ],
            [
                'base_collection_id' => 3,
                'statement' => 'Meu dia a dia de trabalho é agradável.',
                'inverted' => false,
                'group' => OCGroup::MOTIVATION_VALUES_AND_PURPOSES
            ],
            [
                'base_collection_id' => 3,
                'statement' => 'Acredito que as práticas mostradas pela empresa na minha integração condizem de fato com o meu dia a dia.',
                'inverted' => false,
                'group' => OCGroup::MOTIVATION_VALUES_AND_PURPOSES
            ],
            [
                'base_collection_id' => 3,
                'statement' => 'Considero meu ambiente de trabalho respeitoso.',
                'inverted' => false,
                'group' => OCGroup::MOTIVATION_VALUES_AND_PURPOSES
            ],
            [
                'base_collection_id' => 3,
                'statement' => 'Os meus colegas de trabalho me ajudam quando há necessidade.',
                'inverted' => false,
                'group' => OCGroup::MOTIVATION_VALUES_AND_PURPOSES
            ],
            [
                'base_collection_id' => 3,
                'statement' => 'Gosto do que faço.',
                'inverted' => false,
                'group' => OCGroup::MOTIVATION_VALUES_AND_PURPOSES
            ],
            [
                'base_collection_id' => 3,
                'statement' => 'Contribuo de maneira efetiva para atingir as metas estabelecidas na empresa.',
                'inverted' => false,
                'group' => OCGroup::MOTIVATION_VALUES_AND_PURPOSES
            ],
            [
                'base_collection_id' => 3,
                'statement' => 'As pessoas aqui são bem tratadas, independente de raça, cor, sexo, idade ou posição na empresa.',
                'inverted' => false,
                'group' => OCGroup::MOTIVATION_VALUES_AND_PURPOSES
            ],
            [
                'base_collection_id' => 3,
                'statement' => 'Me sinto valorizado aqui na empresa.',
                'inverted' => false,
                'group' => OCGroup::MOTIVATION_VALUES_AND_PURPOSES
            ],
        ]);
    }
}