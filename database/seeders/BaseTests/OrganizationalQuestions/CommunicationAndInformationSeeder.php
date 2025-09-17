<?php

namespace Database\Seeders\BaseTests\OrganizationalQuestions;

use App\Enums\CollectionFactorTypes;
use App\Models\BaseQuestion;
use Illuminate\Database\Seeder;

class CommunicationAndInformationSeeder extends Seeder
{
    public function run(): void
    {
        BaseQuestion::insert([
            [
                'base_collection_id' => 2,
                'statement' => 'Sou estimulado a preocupar-me com a qualidade do meu trabalho e entregar ao cliente aquilo que prometemos.',
                'inverted' => false,
                'group' => CollectionFactorTypes::COMMUNICATION_AND_INFORMATION
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Tenho acesso e conheço as IT\'s - Instruções de Trabalho, MAN\'s - Manuais e PR - Procedimentos do meu setor.',
                'inverted' => false,
                'group' => CollectionFactorTypes::COMMUNICATION_AND_INFORMATION
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Conheço a Política da Qualidade, Missão, Visão e Valores da empresa.',
                'inverted' => false,
                'group' => CollectionFactorTypes::COMMUNICATION_AND_INFORMATION
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Recebo informações de forma ágil e adequada.',
                'inverted' => false,
                'group' => CollectionFactorTypes::COMMUNICATION_AND_INFORMATION
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Considero importante a presença da empresa nas redes sociais como forma de comunicação.',
                'inverted' => false,
                'group' => CollectionFactorTypes::COMMUNICATION_AND_INFORMATION
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'No meu setor tomamos ações para combater o desperdício de materiais e zelar pela conservação de máquinas e equipamentos.',
                'inverted' => false,
                'group' => CollectionFactorTypes::COMMUNICATION_AND_INFORMATION
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Considero os murais um importante canal de comunicação da empresa.',
                'inverted' => false,
                'group' => CollectionFactorTypes::COMMUNICATION_AND_INFORMATION
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Considero o conteúdo apresentado nas TV\'s (televisores) muito relevante para me manter informado sobre assuntos da empresa.',
                'inverted' => false,
                'group' => CollectionFactorTypes::COMMUNICATION_AND_INFORMATION
            ],
            [
                'base_collection_id' => 2,
                'statement' => 'Considero as TV\'s (televisores) um importante canal de comunicação da empresa.',
                'inverted' => false,
                'group' => CollectionFactorTypes::COMMUNICATION_AND_INFORMATION
            ],
        ]);
    }
}