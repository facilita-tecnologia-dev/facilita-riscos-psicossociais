<?php

namespace Database\Seeders\BaseTests\OrganizationalQuestions;

use App\Enums\CollectionFactorTypes;
use App\Models\BaseQuestion;
use Illuminate\Database\Seeder;

class MotivationValuesAndPurposesSeeder extends Seeder
{
    public function run(): void
    {
        BaseQuestion::insert([
            [
                'base_collection_id' => 2,
                'statement' => 'Vejo possibilidades de crescimento profissional.',
                'inverted' => false,
                'group' => CollectionFactorTypes::MOTIVATION_VALUES_AND_PURPOSES
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Meu dia a dia de trabalho é agradável.',
                'inverted' => false,
                'group' => CollectionFactorTypes::MOTIVATION_VALUES_AND_PURPOSES
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Acredito que as práticas mostradas pela empresa na minha integração condizem de fato com o meu dia a dia.',
                'inverted' => false,
                'group' => CollectionFactorTypes::MOTIVATION_VALUES_AND_PURPOSES
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Considero meu ambiente de trabalho respeitoso.',
                'inverted' => false,
                'group' => CollectionFactorTypes::MOTIVATION_VALUES_AND_PURPOSES
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Os meus colegas de trabalho me ajudam quando há necessidade.',
                'inverted' => false,
                'group' => CollectionFactorTypes::MOTIVATION_VALUES_AND_PURPOSES
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Gosto do que faço.',
                'inverted' => false,
                'group' => CollectionFactorTypes::MOTIVATION_VALUES_AND_PURPOSES
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Contribuo de maneira efetiva para atingir as metas estabelecidas na empresa.',
                'inverted' => false,
                'group' => CollectionFactorTypes::MOTIVATION_VALUES_AND_PURPOSES
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'As pessoas aqui são bem tratadas, independente de raça, cor, sexo, idade ou posição na empresa.',
                'inverted' => false,
                'group' => CollectionFactorTypes::MOTIVATION_VALUES_AND_PURPOSES
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Me sinto valorizado aqui na empresa.',
                'inverted' => false,
                'group' => CollectionFactorTypes::MOTIVATION_VALUES_AND_PURPOSES
            ],
        ]);
    }
}