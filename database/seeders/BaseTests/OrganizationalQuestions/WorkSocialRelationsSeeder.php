<?php

namespace Database\Seeders\BaseTests\OrganizationalQuestions;

use App\Enums\CollectionFactorTypes;
use App\Models\BaseQuestion;
use Illuminate\Database\Seeder;

class WorkSocialRelationsSeeder extends Seeder
{
    public function run(): void
    {
        BaseQuestion::insert([
            [
                'base_collection_id' => 2,
                'statement' => 'Eu tenho relação de confiança e parceria com meus colegas de trabalho.',
                'inverted' => false,
                'group' => CollectionFactorTypes::WORK_SOCIAL_RELATIONS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Posso contar com a colaboração das pessoas no meu grupo de trabalho.',
                'inverted' => false,
                'group' => CollectionFactorTypes::WORK_SOCIAL_RELATIONS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Sinto-me a vontade para sugerir ideias para meus colegas.',
                'inverted' => false,
                'group' => CollectionFactorTypes::WORK_SOCIAL_RELATIONS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Meu gestor é claro nas funções que delega.',
                'inverted' => false,
                'group' => CollectionFactorTypes::WORK_SOCIAL_RELATIONS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'A comunicação entre meu gestor e funcionários é transparente.',
                'inverted' => false,
                'group' => CollectionFactorTypes::WORK_SOCIAL_RELATIONS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Acredito que minha liderança reconhece o meu potencial.',
                'inverted' => false,
                'group' => CollectionFactorTypes::WORK_SOCIAL_RELATIONS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Acredito que minhas entregas são valorizadas.',
                'inverted' => false,
                'group' => CollectionFactorTypes::WORK_SOCIAL_RELATIONS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Me sinto confortável para conversar com a minha liderança.',
                'inverted' => false,
                'group' => CollectionFactorTypes::WORK_SOCIAL_RELATIONS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Minha opinião é levada em consideração para a tomada de decisões.',
                'inverted' => false,
                'group' => CollectionFactorTypes::WORK_SOCIAL_RELATIONS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Meu superior oferece o suporte necessário para a realização do trabalho.',
                'inverted' => false,
                'group' => CollectionFactorTypes::WORK_SOCIAL_RELATIONS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Minha liderança me incentiva a aprender e me desenvolver para o meu crescimento profissional.',
                'inverted' => false,
                'group' => CollectionFactorTypes::WORK_SOCIAL_RELATIONS
            ],
        ]);
    }
}