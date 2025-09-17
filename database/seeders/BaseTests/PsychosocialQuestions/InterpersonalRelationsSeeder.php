<?php

namespace Database\Seeders\BaseTests\PsychosocialQuestions;

use App\Enums\CollectionFactorTypes;
use App\Models\BaseQuestion;
use Illuminate\Database\Seeder;

class InterpersonalRelationsSeeder extends Seeder
{
    public function run(): void
    {
        BaseQuestion::insert([
            [
                'base_collection_id' => 1,
                'statement' => 'Há qualidade na comunicação entre os funcionários.',
                'inverted' => false,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'A submissão do meu chefe a ordens superiores me causa revolta.',
                'inverted' => false,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Meu trabalho me faz sofrer.',
                'inverted' => false,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Submeter meu trabalho a decisões políticas é fonte de revolta.',
                'inverted' => false,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Sinto-me isolado(a) no trabalho.',
                'inverted' => false,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Recebo comentários ou gestos de conotação sexual indesejados.',
                'inverted' => false,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Sinto-me pressionado(a) por avanços não consentidos no ambiente de trabalho.',
                'inverted' => false,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Evito interações com certos colegas por medo de assédio.',
                'inverted' => false,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Sofro intimidações ou ameaças verbais no trabalho.',
                'inverted' => false,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Há comportamentos agressivos ou hostis entre colegas/gestores.',
                'inverted' => false,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Sinto medo de retaliação por denunciar problemas.',
                'inverted' => false,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Impaciência com as pessoas em geral.',
                'inverted' => false,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Vontade de ficar sozinho.',
                'inverted' => false,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Perda da autoconfiança.',
                'inverted' => false,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Tristeza.',
                'inverted' => false,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Vontade de desistir de tudo.',
                'inverted' => false,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Sensação de vazio.',
                'inverted' => false,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
            [
                'base_collection_id' => 1,
                'statement' => 'Posso contar com ajuda dos meus colegas quando o trabalho é difícil.',
                'inverted' => true,
                'group' => CollectionFactorTypes::INTERPERSONAL_RELATIONS
            ],
        ]);
    }
}
