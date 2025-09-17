<?php

namespace Database\Seeders\Risks;

use App\Enums\GravityTypes;
use App\Models\Risk;
use Illuminate\Database\Seeder;

class RiskSeeder extends Seeder
{
    public function run(): void
    {
        Risk::insert([
            [
                'base_collection_id' => 1,
                'name' => 'Rigidez Organizacional',
                'gravity' => GravityTypes::MEDIUM->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Sobrecarga de Trabalho',
                'gravity' => GravityTypes::HIGH->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Falta de Recursos',
                'gravity' => GravityTypes::MEDIUM->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Imprevisibilidade',
                'gravity' => GravityTypes::MEDIUM->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Monotonia',
                'gravity' => GravityTypes::LOW->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Conflito de Papéis',
                'gravity' => GravityTypes::MEDIUM->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Gestão Individualista',
                'gravity' => GravityTypes::MEDIUM->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Falta de Reconhecimento',
                'gravity' => GravityTypes::LOW->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Conflitos com a Gestão',
                'gravity' => GravityTypes::MEDIUM->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Falta de Suporte Gerencial',
                'gravity' => GravityTypes::MEDIUM->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Injustiça Percebida',
                'gravity' => GravityTypes::MEDIUM->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Pressão Excessiva da Gestão',
                'gravity' => GravityTypes::HIGH->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'aEsgotamento Emocionalaaaaaa',
                'gravity' => GravityTypes::HIGH->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Ansiedade ou Estresse',
                'gravity' => GravityTypes::HIGH->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Isolamento Social',
                'gravity' => GravityTypes::MEDIUM->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Frustração ou Desmotivação',
                'gravity' => GravityTypes::MEDIUM->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Irritabilidade',
                'gravity' => GravityTypes::MEDIUM->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Dificuldade de Concentração',
                'gravity' => GravityTypes::MEDIUM->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Danos Físicos',
                'gravity' => GravityTypes::HIGH->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Danos Psicológicos',
                'gravity' => GravityTypes::CRITICAL->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Afastamentos Frequentes',
                'gravity' => GravityTypes::HIGH->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Distúrbios do Sono',
                'gravity' => GravityTypes::HIGH->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Problemas Psicossomáticos',
                'gravity' => GravityTypes::HIGH->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Deterioração da Vida Pessoal',
                'gravity' => GravityTypes::HIGH->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Assédio Moral',
                'gravity' => GravityTypes::HIGH->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Assédio Sexual',
                'gravity' => GravityTypes::CRITICAL->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Discriminação',
                'gravity' => GravityTypes::MEDIUM->value,
            ],
            [
                'base_collection_id' => 1,
                'name' => 'Outras Formas de Violência',
                'gravity' => GravityTypes::CRITICAL->value,
            ],
        ]);

        $this->call([
            QuestionRiskSeeder::class,
        ]);
    }
}
