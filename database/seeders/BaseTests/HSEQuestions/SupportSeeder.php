<?php

namespace Database\Seeders\BaseTests\HSEQuestions;

use App\Enums\HSE\HSEGroup;
use App\Models\BaseQuestion;
use Illuminate\Database\Seeder;

class SupportSeeder extends Seeder
{
    public function run(): void
    {
        BaseQuestion::insert([
            [
                'base_collection_id' => 2,
                'statement' => 'Se o trabalho fica difícil, meus colegas me ajudam.',
                'inverted' => false,
                'group' => HSEGroup::SUPPORT
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Recebo retorno sobre os trabalhos que realizo.',
                'inverted' => false,
                'group' => HSEGroup::SUPPORT
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Posso contar com a ajuda do meu chefe imediato para resolver problemas do trabalho.',
                'inverted' => false,
                'group' => HSEGroup::SUPPORT
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Recebo a ajuda e o apoio necessário dos meus colegas.',
                'inverted' => false,
                'group' => HSEGroup::SUPPORT
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Sou respeitado como eu mereço pelos meus colegas.',
                'inverted' => false,
                'group' => HSEGroup::SUPPORT
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Posso falar com meu chefe imediato sobre algo que me incomodou no trabalho.',
                'inverted' => false,
                'group' => HSEGroup::SUPPORT
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Meus colegas estão dispostos a ouvir meus problemas relacionados ao trabalho.',
                'inverted' => false,
                'group' => HSEGroup::SUPPORT
            ],
            
            [
                'base_collection_id' => 2,
                'statement' => 'Recebo apoio quando realizo trabalho que pode ser emocionalmente desgastante.',
                'inverted' => false,
                'group' => HSEGroup::SUPPORT
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Meu chefe imediato me motiva no trabalho.',
                'inverted' => false,
                'group' => HSEGroup::SUPPORT
            ],
        ]);
    }
}