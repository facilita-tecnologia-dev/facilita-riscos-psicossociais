<?php

namespace Database\Seeders\BaseTests\HSEQuestions;

use App\Enums\HSE\HSEGroup;
use App\Models\BaseQuestion;
use Illuminate\Database\Seeder;

class RelationshipsSeeder extends Seeder
{
    public function run(): void
    {
        BaseQuestion::insert([
            [
                'base_collection_id' => 2,
                'statement' => 'Estou sujeito a assédio pessoal na forma de palavras ou comportamentos rudes.',
                'inverted' => false,
                'group' => HSEGroup::RELATIONSHIPS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Existem conflitos entre os colegas de trabalho.',
                'inverted' => false,
                'group' => HSEGroup::RELATIONSHIPS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Estou sujeito a constrangimentos no trabalho.',
                'inverted' => false,
                'group' => HSEGroup::RELATIONSHIPS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Os relacionamentos no trabalho são tensos.',
                'inverted' => false,
                'group' => HSEGroup::RELATIONSHIPS
            ],
        ]);
    }
}