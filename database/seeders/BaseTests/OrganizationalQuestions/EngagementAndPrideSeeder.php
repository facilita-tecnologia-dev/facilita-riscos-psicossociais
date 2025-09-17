<?php

namespace Database\Seeders\BaseTests\OrganizationalQuestions;

use App\Enums\CollectionFactorTypes;
use App\Models\BaseQuestion;
use Illuminate\Database\Seeder;

class EngagementAndPrideSeeder extends Seeder
{
    public function run(): void
    {
        BaseQuestion::insert([
            [
                'base_collection_id' => 2,
                'statement' => 'Acredito que a empresa se empenhará para corrigir os problemas detectados nesta pesquisa.',
                'inverted' => false,
                'group' => CollectionFactorTypes::ENGAGEMENT_AND_PRIDE
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Considero-me comprometido com minhas atividades.',
                'inverted' => false,
                'group' => CollectionFactorTypes::ENGAGEMENT_AND_PRIDE
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Cumpro as responsabilidades que são destinadas a minha função.',
                'inverted' => false,
                'group' => CollectionFactorTypes::ENGAGEMENT_AND_PRIDE
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Eu indicaria um amigo ou parente para trabalhar na empresa.',
                'inverted' => false,
                'group' => CollectionFactorTypes::ENGAGEMENT_AND_PRIDE
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'O meu trabalho proporciona um sentimento de realização profissional.',
                'inverted' => false,
                'group' => CollectionFactorTypes::ENGAGEMENT_AND_PRIDE
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'A empresa possui uma boa imagem perante a comunidade.',
                'inverted' => false,
                'group' => CollectionFactorTypes::ENGAGEMENT_AND_PRIDE
            ],
        ]);
    }
}