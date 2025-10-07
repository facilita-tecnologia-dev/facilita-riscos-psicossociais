<?php

namespace Database\Seeders\BaseTests\OrganizationalQuestions;

use App\Enums\OC\OCGroup;
use App\Models\BaseQuestion;
use Illuminate\Database\Seeder;

class EngagementAndPrideSeeder extends Seeder
{
    public function run(): void
    {
        BaseQuestion::insert([
            [
                'base_collection_id' => 3,
                'statement' => 'Acredito que a empresa se empenhará para corrigir os problemas detectados nesta pesquisa.',
                'inverted' => false,
                'group' => OCGroup::ENGAGEMENT_AND_PRIDE
            ],
            [
                'base_collection_id' => 3,
                'statement' => 'Considero-me comprometido com minhas atividades.',
                'inverted' => false,
                'group' => OCGroup::ENGAGEMENT_AND_PRIDE
            ],
            [
                'base_collection_id' => 3,
                'statement' => 'Cumpro as responsabilidades que são destinadas a minha função.',
                'inverted' => false,
                'group' => OCGroup::ENGAGEMENT_AND_PRIDE
            ],
            [
                'base_collection_id' => 3,
                'statement' => 'Eu indicaria um amigo ou parente para trabalhar na empresa.',
                'inverted' => false,
                'group' => OCGroup::ENGAGEMENT_AND_PRIDE
            ],
            [
                'base_collection_id' => 3,
                'statement' => 'O meu trabalho proporciona um sentimento de realização profissional.',
                'inverted' => false,
                'group' => OCGroup::ENGAGEMENT_AND_PRIDE
            ],
            [
                'base_collection_id' => 3,
                'statement' => 'A empresa possui uma boa imagem perante a comunidade.',
                'inverted' => false,
                'group' => OCGroup::ENGAGEMENT_AND_PRIDE
            ],
        ]);
    }
}