<?php

namespace Database\Seeders\BaseTests\OrganizationalQuestions;

use App\Enums\CollectionFactorTypes;
use App\Models\BaseQuestion;
use Illuminate\Database\Seeder;

class WorkConditionsSeeder extends Seeder
{
    public function run(): void
    {
        BaseQuestion::insert([
            [
                'base_collection_id' => 2,
                'statement' => 'Eu recebo as ferramentas e os recursos necessários para realizar o meu trabalho.',
                'inverted' => false,
                'group' => CollectionFactorTypes::WORK_CONDITIONS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Meu ambiente/posto de trabalho é limpo e organizado.',
                'inverted' => false,
                'group' => CollectionFactorTypes::WORK_CONDITIONS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'As áreas de uso comum, possuem uma estrutura satisfatória, limpas e organizadas.',
                'inverted' => false,
                'group' => CollectionFactorTypes::WORK_CONDITIONS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'A empresa zela pela segurança no trabalho e se preocupa com a saúde do trabalhador.',
                'inverted' => false,
                'group' => CollectionFactorTypes::WORK_CONDITIONS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'As máquinas, equipamentos e EPIs que utilizo me dão segurança para realizar meu trabalho.',
                'inverted' => false,
                'group' => CollectionFactorTypes::WORK_CONDITIONS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Sou incentivado a usar adequadamente os meus EPI\'s.',
                'inverted' => false,
                'group' => CollectionFactorTypes::WORK_CONDITIONS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Recebo treinamentos e orientações suficientes para prevenir acidentes.',
                'inverted' => false,
                'group' => CollectionFactorTypes::WORK_CONDITIONS
            ],
        ]);
    }
}