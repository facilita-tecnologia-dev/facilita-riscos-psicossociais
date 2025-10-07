<?php

namespace Database\Seeders\BaseTests\HSEQuestions;

use App\Enums\HSE\HSEGroup;
use App\Models\BaseQuestion;
use Illuminate\Database\Seeder;

class DemandsSeeder extends Seeder
{
    public function run(): void
    {
        BaseQuestion::insert([
            [
                'base_collection_id' => 2,
                'statement' => 'As exigências de trabalho feitas por colegas e supervisores são difíceis de conciliar.',
                'inverted' => false,
                'group' => HSEGroup::DEMANDS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Tenho prazos impossíveis de serem cumpridos.',
                'inverted' => false,
                'group' => HSEGroup::DEMANDS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Tenho que trabalhar muito intensamente.',
                'inverted' => false,
                'group' => HSEGroup::DEMANDS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Preciso deixar de lado algumas tarefas porque tenho coisas demais para fazer.',
                'inverted' => false,
                'group' => HSEGroup::DEMANDS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Não consigo fazer pausas suficientes.',
                'inverted' => false,
                'group' => HSEGroup::DEMANDS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Sou pressionado para trabalhar por longos períodos.',
                'inverted' => false,
                'group' => HSEGroup::DEMANDS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Tenho que trabalhar muito rápido.',
                'inverted' => false,
                'group' => HSEGroup::DEMANDS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'As pausas temporárias são impossíveis de cumprir.',
                'inverted' => false,
                'group' => HSEGroup::DEMANDS
            ],
        ]);
    }
}