<?php

namespace Database\Seeders\BaseTests\OrganizationalQuestions;

use App\Enums\CollectionFactorTypes;
use App\Models\BaseQuestion;
use Illuminate\Database\Seeder;

class DevelopmentCarreerRecognitionSeeder extends Seeder
{
    public function run(): void
    {
        BaseQuestion::insert([
                [
                    'base_collection_id' => 2,
                    'statement' => 'Tenho interesse em ocupar outros cargos dentro da organização.',
                    'inverted' => false,
                    'group' => CollectionFactorTypes::DEVELOPMENT_CARREER_RECOGNITION
                ],
                [
                    'base_collection_id' => 2,
                    'statement' => 'Percebo meu crescimento dentro da empresa.',
                    'inverted' => false,
                    'group' => CollectionFactorTypes::DEVELOPMENT_CARREER_RECOGNITION
                ],
                [
                    'base_collection_id' => 2,
                    'statement' => 'Sei quais são as entregas necessárias para alcançar novas posições.',
                    'inverted' => false,
                    'group' => CollectionFactorTypes::DEVELOPMENT_CARREER_RECOGNITION
                ],
                [
                    'base_collection_id' => 2,
                    'statement' => 'A empresa oferece programas de capacitação e treinamento para ajudar no desenvolvimento das competências necessárias para o avanço na carreira.',
                    'inverted' => false,
                    'group' => CollectionFactorTypes::DEVELOPMENT_CARREER_RECOGNITION
                ],
                [
                    'base_collection_id' => 2,
                    'statement' => 'Me sinto encorajado a buscar oportunidades de desenvolvimento fora do seu cargo atual.',
                    'inverted' => false,
                    'group' => CollectionFactorTypes::DEVELOPMENT_CARREER_RECOGNITION
                ],
                [
                    'base_collection_id' => 2,
                    'statement' => 'Acredito que há igualdade de oportunidades de crescimento e promoção para todos os funcionários, independentemente de fatores como gênero, raça ou idade.',
                    'inverted' => false,
                    'group' => CollectionFactorTypes::DEVELOPMENT_CARREER_RECOGNITION
                ],
                [
                    'base_collection_id' => 2,
                    'statement' => 'Estou satisfeito com a estrutura do restaurante e alimentação oferecida pela empresa.',
                    'inverted' => false,
                    'group' => CollectionFactorTypes::DEVELOPMENT_CARREER_RECOGNITION
                ],
                [
                    'base_collection_id' => 2,
                    'statement' => 'Vejo perspectiva de progresso profissional na empresa.',
                    'inverted' => false,
                    'group' => CollectionFactorTypes::DEVELOPMENT_CARREER_RECOGNITION
                ],
                [
                    'base_collection_id' => 2,
                    'statement' => 'Se eu recebesse uma oferta em outra empresa, com salário maior ou igual ao meu, mesmo assim eu ficaria na empresa.',
                    'inverted' => false,
                    'group' => CollectionFactorTypes::DEVELOPMENT_CARREER_RECOGNITION
                ],
                [
                    'base_collection_id' => 2,
                    'statement' => 'Estou satisfeito com o atendimento do RH na empresa.',
                    'inverted' => false,
                    'group' => CollectionFactorTypes::DEVELOPMENT_CARREER_RECOGNITION
                ],
                [
                    'base_collection_id' => 2,
                    'statement' => 'Meu salário está compatível com o que o mercado pratica para função similar a minha.',
                    'inverted' => false,
                    'group' => CollectionFactorTypes::DEVELOPMENT_CARREER_RECOGNITION
                ],
                [
                    'base_collection_id' => 2,
                    'statement' => 'Estou satiseito com o atendimento do Médico da empresa.',
                    'inverted' => false,
                    'group' => CollectionFactorTypes::DEVELOPMENT_CARREER_RECOGNITION
                ],
                [
                    'base_collection_id' => 2,
                    'statement' => 'Estou satisfeito com o meu horário de trabalho.',
                    'inverted' => false,
                    'group' => CollectionFactorTypes::DEVELOPMENT_CARREER_RECOGNITION
                ],
                [
                    'base_collection_id' => 2,
                    'statement' => 'Estou satisfeito com o Transporte oferecido pela empresa.',
                    'inverted' => false,
                    'group' => CollectionFactorTypes::DEVELOPMENT_CARREER_RECOGNITION
                ],
                [
                    'base_collection_id' => 2,
                    'statement' => 'Estou satisfeito com o Plano de Saúde oferecido pela empresa.',
                    'inverted' => false,
                    'group' => CollectionFactorTypes::DEVELOPMENT_CARREER_RECOGNITION
                ],
                [
                    'base_collection_id' => 2,
                    'statement' => 'Estou satisfeito com o Auxílio Alimentação oferecido pela empresa.',
                    'inverted' => false,
                    'group' => CollectionFactorTypes::DEVELOPMENT_CARREER_RECOGNITION
                ],
        ]);
    }
}