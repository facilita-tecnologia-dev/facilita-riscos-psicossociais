<?php

namespace Database\Seeders\BaseTests\HSEQuestions;

use App\Enums\Psychosocial\HSE\HSEGroup;
use App\Models\BaseQuestion;
use Illuminate\Database\Seeder;

class DemandsSeeder extends Seeder
{
    public function run(): void
    {
        BaseQuestion::insert([
            [
                'base_collection_id' => 2,
                'statement' => 'As exigências de trabalho feitas por colegas e supervisores são difíceis de conciliar?',
                'inverted' => true,
                'group' => HSEGroup::DEMANDS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Tenho prazos impossíveis de serem cumpridos?',
                'inverted' => true,
                'group' => HSEGroup::DEMANDS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Tenho que trabalhar muito intensamente?',
                'inverted' => true,
                'group' => HSEGroup::DEMANDS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Preciso deixar de lado algumas tarefas porque tenho coisas demais para fazer?',
                'inverted' => true,
                'group' => HSEGroup::DEMANDS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Não consigo fazer pausas suficientes?',
                'inverted' => true,
                'group' => HSEGroup::DEMANDS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Sou pressionado para trabalhar por longos períodos?',
                'inverted' => true,
                'group' => HSEGroup::DEMANDS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Tenho que trabalhar muito rápido?',
                'inverted' => true,
                'group' => HSEGroup::DEMANDS
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'As pausas temporárias são impossíveis de cumprir?',
                'inverted' => true,
                'group' => HSEGroup::DEMANDS
            ],
        ]);
    }
}