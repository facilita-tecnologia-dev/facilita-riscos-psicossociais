<?php

namespace Database\Seeders\ActionPlan;

use App\Enums\BaseCollection;
use App\Enums\PROART\PROARTControlActionTypes;
use App\Enums\PROART\PROARTHazard;
use App\Models\BaseControlAction;
use App\Models\ControlActionType;
use App\Models\Hazard;
use Illuminate\Database\Seeder;

class PROARTControlActionsSeeder extends Seeder
{
    public function run(): void
    {
        $risks = Hazard::whereHas('collection', fn($collection) => $collection->where('key', BaseCollection::PROART->value))->get();
        $controlActionTypes = ControlActionType::all();

        // organizational-rigidity
        BaseControlAction::insert([
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Redesenhar processos para aumentar autonomia dos trabalhadores, permitindo flexibilidade na execução de tarefas (ISO 45003, Cláusula 8.1.2). Exemplo: Implementar métodos ágeis com ciclos de feedback.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Redesenhar processos para aumentar autonomia dos trabalhadores, permitindo flexibilidade na execução de tarefas (ISO 45003, Cláusula 8.1.2). Exemplo: Implementar métodos ágeis com ciclos de feedback.',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Treinamentos para gestores sobre liderança participativa, enfatizando delegação e autonomia (NR-1, Item 1.5.4.1). Estabelecer políticas de tomada de decisão compartilhada.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Treinamentos para gestores sobre liderança participativa, enfatizando delegação e autonomia (NR-1, Item 1.5.4.1). Estabelecer políticas de tomada de decisão compartilhada.',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Criar canais de escuta ativa (ex.: ouvidoria interna) para relatos de rigidez, com resposta em até 7 dias (ISO 45003, Cláusula 10.2).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Criar canais de escuta ativa (ex.: ouvidoria interna) para relatos de rigidez, com resposta em até 7 dias (ISO 45003, Cláusula 10.2).',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Realizar pesquisas anuais de clima organizacional com perguntas específicas sobre autonomia (ex.: item 4 do questionário) para monitorar escores < 2,5 (Improvável).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Realizar pesquisas anuais de clima organizacional com perguntas específicas sobre autonomia (ex.: item 4 do questionário) para monitorar escores < 2,5 (Improvável).',
            ],
        ]);

        // work-overload
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Revisar planejamento de tarefas para ajustar prazos e carga de trabalho, com base em análise de capacidade (ISO 45003, Cláusula 8.1.2). Exemplo: Limitar horas extras a < 10% do quadro (Improvável).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Revisar planejamento de tarefas para ajustar prazos e carga de trabalho, com base em análise de capacidade (ISO 45003, Cláusula 8.1.2). Exemplo: Limitar horas extras a < 10% do quadro (Improvável).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => ' Implementar política de limite de horas extras (máximo 2h/dia, CLT, Art. 59) e rodízio de tarefas para reduzir pressão (NR-1, Item 1.5.4.1). Treinar gestores para identificar sinais de sobrecarga.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => ' Implementar política de limite de horas extras (máximo 2h/dia, CLT, Art. 59) e rodízio de tarefas para reduzir pressão (NR-1, Item 1.5.4.1). Treinar gestores para identificar sinais de sobrecarga.',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Oferecer suporte psicológico via Programa de Assistência ao Empregado (PAE), com acesso a psicólogos (ISO 45003, Cláusula 8.1.3).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Oferecer suporte psicológico via Programa de Assistência ao Empregado (PAE), com acesso a psicólogos (ISO 45003, Cláusula 8.1.3).',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar indicadores (horas extras, absenteísmo, queixas) trimestralmente, com metas de redução para < 40% (NR-1, Item 1.5.5).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar indicadores (horas extras, absenteísmo, queixas) trimestralmente, com metas de redução para < 40% (NR-1, Item 1.5.5).',
            ],
        ]);

        // lack-of-resources
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Investir em equipamentos e infraestrutura adequados, com base em avaliações ergonômicas (NR-17, Item 17.3.3; ISO 45003, Cláusula 8.1.2).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Investir em equipamentos e infraestrutura adequados, com base em avaliações ergonômicas (NR-17, Item 17.3.3; ISO 45003, Cláusula 8.1.2).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Criar comitês de ergonomia com participação de trabalhadores para identificar necessidades de recursos (NR-1, Item 1.5.4.2). Estabelecer cronograma de manutenção preventiva.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Criar comitês de ergonomia com participação de trabalhadores para identificar necessidades de recursos (NR-1, Item 1.5.4.2). Estabelecer cronograma de manutenção preventiva.',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir acesso a ferramentas temporárias (ex.: aluguel de equipamentos) enquanto recursos permanentes não são adquiridos.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir acesso a ferramentas temporárias (ex.: aluguel de equipamentos) enquanto recursos permanentes não são adquiridos.',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir acesso a ferramentas temporárias (ex.: aluguel de equipamentos) enquanto recursos permanentes não são adquiridos.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir acesso a ferramentas temporárias (ex.: aluguel de equipamentos) enquanto recursos permanentes não são adquiridos.',
            ],
        ]);

        // unpredictability
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Implementar planos de comunicação para mudanças organizacionais, com consulta prévia aos trabalhadores (ISO 45003, Cláusula 8.1.2; item 15 do questionário).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Implementar planos de comunicação para mudanças organizacionais, com consulta prévia aos trabalhadores (ISO 45003, Cláusula 8.1.2; item 15 do questionário).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Estabelecer políticas de notificação de mudanças com antecedência mínima de 30 dias (NR-1, Item 1.5.4.2). Treinar gestores em gestão de mudanças.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Estabelecer políticas de notificação de mudanças com antecedência mínima de 30 dias (NR-1, Item 1.5.4.2). Treinar gestores em gestão de mudanças.',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Criar fóruns regulares para ouvir preocupações dos trabalhadores durante transições.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Criar fóruns regulares para ouvir preocupações dos trabalhadores durante transições.',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar queixas (< 5%) e absenteísmo (< 10%) relacionados a mudanças, com grupos focais para escores > 3,0.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar queixas (< 5%) e absenteísmo (< 10%) relacionados a mudanças, com grupos focais para escores > 3,0.',
            ],
        ]);

        // monotony
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar queixas (< 5%) e absenteísmo (< 10%) relacionados a mudanças, com grupos focais para escores > 3,0.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar queixas (< 5%) e absenteísmo (< 10%) relacionados a mudanças, com grupos focais para escores > 3,0.',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Oferecer treinamentos para diversificação de habilidades (NR-1, Item 1.5.4.1). Estabelecer pausas regulares (NR-17, Item 17.6.4).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Oferecer treinamentos para diversificação de habilidades (NR-1, Item 1.5.4.1). Estabelecer pausas regulares (NR-17, Item 17.6.4).',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Implementar atividades de integração (ex.: dinâmicas de grupo) para aumentar engajamento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Implementar atividades de integração (ex.: dinâmicas de grupo) para aumentar engajamento.',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar escores < 2,5 (item 2, 54) e queixas < 5% para evitar desmotivação.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar escores < 2,5 (item 2, 54) e queixas < 5% para evitar desmotivação.',
            ],
        ]);

        // role-conflict
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Clarificar descrições de cargos e responsabilidades, com validação dos trabalhadores (ISO 45003, Cláusula 8.1.2).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Clarificar descrições de cargos e responsabilidades, com validação dos trabalhadores (ISO 45003, Cláusula 8.1.2).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Treinar gestores para emitir orientações consistentes (NR-1, Item 1.5.4.1). Criar fluxos de comunicação claros (ex.: organogramas).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Treinar gestores para emitir orientações consistentes (NR-1, Item 1.5.4.1). Criar fluxos de comunicação claros (ex.: organogramas).',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Estabelecer mediação interna para resolver conflitos de papéis.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Estabelecer mediação interna para resolver conflitos de papéis.',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar escores < 2,5 (itens 3, 5) e queixas < 5% via pesquisas trimestrais.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar escores < 2,5 (itens 3, 5) e queixas < 5% via pesquisas trimestrais.',
            ],
        ]);

        // --------------------------------------------------------------------------------------

        // individualistic-management
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Promover cultura colaborativa com tomada de decisão participativa (ISO 45003, Cláusula 8.1.2; itens 17, 23–25, 27, 29–30).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Promover cultura colaborativa com tomada de decisão participativa (ISO 45003, Cláusula 8.1.2; itens 17, 23–25, 27, 29–30).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Treinar gestores em liderança colaborativa (NR-1, Item 1.5.4.1). Estabelecer comitês de decisão com representantes dos trabalhadores.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Treinar gestores em liderança colaborativa (NR-1, Item 1.5.4.1). Estabelecer comitês de decisão com representantes dos trabalhadores.',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Criar canais de denúncia anônima para relatar práticas individualistas (ISO 45003, Cláusula 10.2).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Criar canais de denúncia anônima para relatar práticas individualistas (ISO 45003, Cláusula 10.2).',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar rotatividade (< 10%) e queixas (< 5%) trimestralmente.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar rotatividade (< 10%) e queixas (< 5%) trimestralmente.',
            ],
        ]);

        // lack-of-recognition
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Implementar programas de reconhecimento (ex.: premiações por mérito) baseados em critérios transparentes (ISO 45003, Cláusula 8.1.2; itens 18, 20, 22, 26).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Implementar programas de reconhecimento (ex.: premiações por mérito) baseados em critérios transparentes (ISO 45003, Cláusula 8.1.2; itens 18, 20, 22, 26).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Treinar gestores para elogiar contribuições (NR-1, Item 1.5.4.1). Estabelecer feedback mensal.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Treinar gestores para elogiar contribuições (NR-1, Item 1.5.4.1). Estabelecer feedback mensal.',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Criar espaços para feedback dos trabalhadores sobre reconhecimento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Criar espaços para feedback dos trabalhadores sobre reconhecimento.',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar escores < 2,5 e queixas < 5% via pesquisas anuais.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar escores < 2,5 e queixas < 5% via pesquisas anuais.',
            ],
        ]);

        // management-conflicts
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Promover comunicação aberta entre gestores e subordinados (ISO 45003, Cláusula 8.1.2; itens 16, 36).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Promover comunicação aberta entre gestores e subordinados (ISO 45003, Cláusula 8.1.2; itens 16, 36).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Implementar treinamentos de resolução de conflitos (NR-1, Item 1.5.4.1). Criar política de mediação interna.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Implementar treinamentos de resolução de conflitos (NR-1, Item 1.5.4.1). Criar política de mediação interna.',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir canal de denúncias anônimo com resposta em 7 dias (ISO 45003, Cláusula 10.2).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir canal de denúncias anônimo com resposta em 7 dias (ISO 45003, Cláusula 10.2).',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar rotatividade (< 10%) e queixas (< 5%) trimestralmente.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar rotatividade (< 10%) e queixas (< 5%) trimestralmente.',
            ],
        ]);

        // lack-of-managerial-support
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Fomentar suporte gerencial via políticas de portas abertas e mentorias (ISO 45003, Cláusula 8.1.2; itens 19, 21, 52).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Fomentar suporte gerencial via políticas de portas abertas e mentorias (ISO 45003, Cláusula 8.1.2; itens 19, 21, 52).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Treinar gestores em apoio psicossocial (NR-1, Item 1.5.4.1). Criar redes de apoio entre colegas.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Treinar gestores em apoio psicossocial (NR-1, Item 1.5.4.1). Criar redes de apoio entre colegas.',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Oferecer acesso a PAE para suporte emocional.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Oferecer acesso a PAE para suporte emocional.',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar escores < 2,5 e queixas < 5% via pesquisas semestrais.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar escores < 2,5 e queixas < 5% via pesquisas semestrais.',
            ],
        ]);


        // perceived-injustice
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Estabelecer critérios transparentes para promoções e avaliações (ISO 45003, Cláusula 8.1.2; itens 28, 38).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Estabelecer critérios transparentes para promoções e avaliações (ISO 45003, Cláusula 8.1.2; itens 28, 38).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Criar comitês de ética para revisar decisões (NR-1, Item 1.5.4.2). Treinar gestores em imparcialidade.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Criar comitês de ética para revisar decisões (NR-1, Item 1.5.4.2). Treinar gestores em imparcialidade.',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir canal de denúncias anônimo para relatos de injustiça.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir canal de denúncias anônimo para relatos de injustiça.',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar queixas (< 5%) e rotatividade (< 10%) trimestralmente.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar queixas (< 5%) e rotatividade (< 10%) trimestralmente.',
            ],
        ]);

        // excessive-management-pressure
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Revisar metas para torná-las realistas, com consulta aos trabalhadores (ISO 45003, Cláusula 8.1.2; itens 31, 32).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Revisar metas para torná-las realistas, com consulta aos trabalhadores (ISO 45003, Cláusula 8.1.2; itens 31, 32).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Treinar gestores em liderança motivacional, evitando críticas injustas (NR-1, Item 1.5.4.1). Limitar metas inatingíveis.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Treinar gestores em liderança motivacional, evitando críticas injustas (NR-1, Item 1.5.4.1). Limitar metas inatingíveis.',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Oferecer suporte psicológico via PAE para trabalhadores sob pressão.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Oferecer suporte psicológico via PAE para trabalhadores sob pressão.',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar absenteísmo (< 25%) e queixas (< 5%) trimestralmente.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar absenteísmo (< 25%) e queixas (< 5%) trimestralmente.',
            ],
        ]);

        // --------------------------------------------------------------------------------------

        // emotional-exhaustion
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Reduzir carga de trabalho e horas extras (< 10%) via planejamento (ISO 45003, Cláusula 8.1.2; itens 37, 50, 72).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Reduzir carga de trabalho e horas extras (< 10%) via planejamento (ISO 45003, Cláusula 8.1.2; itens 37, 50, 72).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Implementar programas de bem-estar (ex.: mindfulness, NR-1, Item 1.5.4.1). Limitar turnos prolongados.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Implementar programas de bem-estar (ex.: mindfulness, NR-1, Item 1.5.4.1). Limitar turnos prolongados.',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Oferecer acesso imediato a PAE com psicólogos.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Oferecer acesso imediato a PAE com psicólogos.',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar absenteísmo (< 40%) e afastamentos (< 25%) trimestralmente.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar absenteísmo (< 40%) e afastamentos (< 25%) trimestralmente.',
            ],
        ]);

        // anxiety-or-stress
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Identificar e mitigar fontes de estresse (ex.: prazos irreais) via consultas participativas (ISO 45003, Cláusula 8.1.2; itens 46, 51).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Identificar e mitigar fontes de estresse (ex.: prazos irreais) via consultas participativas (ISO 45003, Cláusula 8.1.2; itens 46, 51).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Oferecer workshops de gestão de estresse (NR-1, Item 1.5.4.1). Estabelecer pausas regulares.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Oferecer workshops de gestão de estresse (NR-1, Item 1.5.4.1). Estabelecer pausas regulares.',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir acesso a suporte psicológico confidencial.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir acesso a suporte psicológico confidencial.',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar escores < 2,5 e queixas < 5% semestralmente.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar escores < 2,5 e queixas < 5% semestralmente.',
            ],
        ]);

        // social-isolation
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Promover integração via atividades de equipe (ISO 45003, Cláusula 8.1.2; itens 39, 47).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Promover integração via atividades de equipe (ISO 45003, Cláusula 8.1.2; itens 39, 47).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Treinar gestores para identificar sinais de exclusão (NR-1, Item 1.5.4.1). Criar redes de apoio entre colegas.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Treinar gestores para identificar sinais de exclusão (NR-1, Item 1.5.4.1). Criar redes de apoio entre colegas.',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir canal de denúncias para relatos de exclusão.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir canal de denúncias para relatos de exclusão.',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar queixas (< 5%) e absenteísmo (< 25%) trimestralmente.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar queixas (< 5%) e absenteísmo (< 25%) trimestralmente.',
            ],
        ]);

        // frustration-or-demotivation
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Alinhar tarefas com propósito organizacional (ISO 45003, Cláusula 8.1.2; itens 55–59).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Alinhar tarefas com propósito organizacional (ISO 45003, Cláusula 8.1.2; itens 55–59).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Oferecer treinamentos de desenvolvimento pessoal (NR-1, Item 1.5.4.1). Criar planos de carreira claros.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Oferecer treinamentos de desenvolvimento pessoal (NR-1, Item 1.5.4.1). Criar planos de carreira claros.',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Oferecer suporte psicológico para desmotivação.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Oferecer suporte psicológico para desmotivação.',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar escores < 2,5 e rotatividade (< 25%) anualmente.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar escores < 2,5 e rotatividade (< 25%) anualmente.',
            ],
        ]);

        // irritability
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Mitigar conflitos interpessoais via mediação (ISO 45003, Cláusula 8.1.2; item 46).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Mitigar conflitos interpessoais via mediação (ISO 45003, Cláusula 8.1.2; item 46).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Treinar equipes em comunicação não violenta (NR-1, Item 1.5.4.1).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Treinar equipes em comunicação não violenta (NR-1, Item 1.5.4.1).',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir canal de denúncias para tensões interpessoais.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir canal de denúncias para tensões interpessoais.',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar queixas (< 5%) e absenteísmo (< 25%) trimestralmente.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar queixas (< 5%) e absenteísmo (< 25%) trimestralmente.',
            ],
        ]);

        // difficulty-concentrating
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Reduzir distrações ambientais (ex.: ruído, NR-17, Item 17.5) e sobrecarga cognitiva (ISO 45003, Cláusula 8.1.2).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Reduzir distrações ambientais (ex.: ruído, NR-17, Item 17.5) e sobrecarga cognitiva (ISO 45003, Cláusula 8.1.2).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Implementar pausas cognitivas (NR-1, Item 1.5.4.1). Oferecer treinamentos de foco.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Implementar pausas cognitivas (NR-1, Item 1.5.4.1). Oferecer treinamentos de foco.',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Oferecer suporte psicológico para estresse cognitivo.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Oferecer suporte psicológico para estresse cognitivo.',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar escores < 2,5 e queixas < 5% semestralmente.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar escores < 2,5 e queixas < 5% semestralmente.',
            ],
        ]);

        // --------------------------------------------------------------------------------------

        // physical-damage
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Implementar programas ergonômicos para prevenir lesões (NR-17, Item 17.3; ISO 45003, Cláusula 8.1.2; itens 63, 64, 66, 69).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Implementar programas ergonômicos para prevenir lesões (NR-17, Item 17.3; ISO 45003, Cláusula 8.1.2; itens 63, 64, 66, 69).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Realizar avaliações ergonômicas trimestrais (NR-1, Item 1.5.4.1). Limitar posturas forçadas.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Realizar avaliações ergonômicas trimestrais (NR-1, Item 1.5.4.1). Limitar posturas forçadas.',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Fornecer EPIs e ajustes ergonômicos individualizados.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Fornecer EPIs e ajustes ergonômicos individualizados.',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar acidentes (< 10%) e queixas (< 5%) semestralmente.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar acidentes (< 10%) e queixas (< 5%) semestralmente.',
            ],
        ]);

        // psychosological-damage
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Mitigar fontes de estresse (ex.: assédio, sobrecarga) via políticas preventivas (ISO 45003, Cláusula 8.1.2; itens 48, 49).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Mitigar fontes de estresse (ex.: assédio, sobrecarga) via políticas preventivas (ISO 45003, Cláusula 8.1.2; itens 48, 49).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Garantir acesso a PAE com psicólogos (NR-1, Item 1.5.4.1). Treinar gestores para identificar sinais de depressão.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Garantir acesso a PAE com psicólogos (NR-1, Item 1.5.4.1). Treinar gestores para identificar sinais de depressão.',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Criar canal de denúncias confidencial com resposta em 7 dias.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Criar canal de denúncias confidencial com resposta em 7 dias.',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar afastamentos (< 25%) e queixas (< 5%) trimestralmente.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar afastamentos (< 25%) e queixas (< 5%) trimestralmente.',
            ],
        ]);

        // frequent-absenteeism
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Revisar condições de trabalho para reduzir riscos psicossociais (ISO 45003, Cláusula 8.1.2; itens 60, 61).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Revisar condições de trabalho para reduzir riscos psicossociais (ISO 45003, Cláusula 8.1.2; itens 60, 61).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Implementar programas de retorno ao trabalho com apoio psicológico (NR-1, Item 1.5.4.1).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Implementar programas de retorno ao trabalho com apoio psicológico (NR-1, Item 1.5.4.1).',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir suporte médico e psicológico para trabalhadores afastados.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir suporte médico e psicológico para trabalhadores afastados.',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar afastamentos (< 10%) e absenteísmo (< 25%) trimestralmente.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar afastamentos (< 10%) e absenteísmo (< 25%) trimestralmente.',
            ],
        ]);

        // sleep-disorders
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Regular turnos para evitar jornadas noturnas prolongadas (NR-17, Item 17.6; ISO 45003, Cláusula 8.1.2; item 65).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Regular turnos para evitar jornadas noturnas prolongadas (NR-17, Item 17.6; ISO 45003, Cláusula 8.1.2; item 65).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Oferecer workshops sobre higiene do sono (NR-1, Item 1.5.4.1).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Oferecer workshops sobre higiene do sono (NR-1, Item 1.5.4.1).',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir acesso a suporte médico para insônia.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir acesso a suporte médico para insônia.',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar absenteísmo (< 25%) e queixas (< 5%) semestralmente.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar absenteísmo (< 25%) e queixas (< 5%) semestralmente.',
            ],
        ]);

        // psychossomatic-problems
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Mitigar estresse via redução de carga de trabalho (ISO 45003, Cláusula 8.1.2; itens 62, 67, 68).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Mitigar estresse via redução de carga de trabalho (ISO 45003, Cláusula 8.1.2; itens 62, 67, 68).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Oferecer programas de bem-estar físico e mental (NR-1, Item 1.5.4.1).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Oferecer programas de bem-estar físico e mental (NR-1, Item 1.5.4.1).',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir acesso a médicos para sintomas psicossomáticos.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir acesso a médicos para sintomas psicossomáticos.',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar absenteísmo (< 25%) e afastamentos (< 10%) trimestralmente.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar absenteísmo (< 25%) e afastamentos (< 10%) trimestralmente.',
            ],
        ]);

        // deterioration-of-personal-life
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Implementar políticas de equilíbrio trabalho-vida (ex.: home office, horários flexíveis, ISO 45003, Cláusula 8.1.2; itens 70, 71).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Implementar políticas de equilíbrio trabalho-vida (ex.: home office, horários flexíveis, ISO 45003, Cláusula 8.1.2; itens 70, 71).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Limitar horas extras (< 10%, NR-1, Item 1.5.4.1). Oferecer workshops de gestão de tempo.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Limitar horas extras (< 10%, NR-1, Item 1.5.4.1). Oferecer workshops de gestão de tempo.',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir acesso a suporte psicológico familiar.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir acesso a suporte psicológico familiar.',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar horas extras (< 10%) e queixas (< 5%) trimestralmente.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar horas extras (< 10%) e queixas (< 5%) trimestralmente.',
            ],
        ]);


        // --------------------------------------------------------------------------------------

        // moral-harassment
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Implementar política de tolerância zero ao assédio moral, com sanções claras (ISO 45003, Cláusula 8.1.2; itens 31, 32, 39).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Implementar política de tolerância zero ao assédio moral, com sanções claras (ISO 45003, Cláusula 8.1.2; itens 31, 32, 39).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Treinar gestores e trabalhadores em identificação de assédio moral (NR-1, Item 1.5.4.1). Criar comitê de ética para investigar denúncias.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Treinar gestores e trabalhadores em identificação de assédio moral (NR-1, Item 1.5.4.1). Criar comitê de ética para investigar denúncias.',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir canal de denúncias anônimo com resposta em 7 dias (ISO 45003, Cláusula 10.2).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir canal de denúncias anônimo com resposta em 7 dias (ISO 45003, Cláusula 10.2).',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar queixas (< 5%) e absenteísmo (< 25%) trimestralmente, com grupos focais para escores > 3,5.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar queixas (< 5%) e absenteísmo (< 25%) trimestralmente, com grupos focais para escores > 3,5.',
            ],
        ]);

        // sexual-harassment
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Adotar política de tolerância zero ao assédio sexual, com medidas disciplinares imediatas (Lei nº 14.457/2022; ISO 45003, Cláusula 8.1.2; itens 40–42).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Adotar política de tolerância zero ao assédio sexual, com medidas disciplinares imediatas (Lei nº 14.457/2022; ISO 45003, Cláusula 8.1.2; itens 40–42).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Realizar treinamentos anuais obrigatórios sobre prevenção de assédio sexual (Lei nº 14.457/2022, Art. 23). Criar comitê de conformidade para investigação.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Realizar treinamentos anuais obrigatórios sobre prevenção de assédio sexual (Lei nº 14.457/2022, Art. 23). Criar comitê de conformidade para investigação.',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir canal de denúncias confidencial com resposta em 5 dias (ISO 45003, Cláusula 10.2).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir canal de denúncias confidencial com resposta em 5 dias (ISO 45003, Cláusula 10.2).',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar queixas (< 1%) e afastamentos (< 10%) mensalmente, com validação qualitativa para escores > 3,0.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar queixas (< 1%) e afastamentos (< 10%) mensalmente, com validação qualitativa para escores > 3,0.',
            ],
        ]);

        // discrimination
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Implementar políticas de diversidade e inclusão, com critérios objetivos para promoções (ISO 45003, Cláusula 8.1.2; itens 33, 34; Decreto nº 62.150/1968).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Implementar políticas de diversidade e inclusão, com critérios objetivos para promoções (ISO 45003, Cláusula 8.1.2; itens 33, 34; Decreto nº 62.150/1968).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Implementar políticas de diversidade e inclusão, com critérios objetivos para promoções (ISO 45003, Cláusula 8.1.2; itens 33, 34; Decreto nº 62.150/1968).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Implementar políticas de diversidade e inclusão, com critérios objetivos para promoções (ISO 45003, Cláusula 8.1.2; itens 33, 34; Decreto nº 62.150/1968).',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir canal de denúncias para discriminação, com resposta em 7 dias.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir canal de denúncias para discriminação, com resposta em 7 dias.',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar queixas (< 5%) e desvantagem injustificada (< 5%) semestralmente.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar queixas (< 5%) e desvantagem injustificada (< 5%) semestralmente.',
            ],
        ]);

        // other-forms-of-violence
        BaseControlAction::insert([
            // Reduction
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Estabelecer política de tolerância zero à violência, com sanções severas (ISO 45003, Cláusula 8.1.2; itens 43–45; Convenção 190 OIT).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Estabelecer política de tolerância zero à violência, com sanções severas (ISO 45003, Cláusula 8.1.2; itens 43–45; Convenção 190 OIT).',
            ],
            // Administrative
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Treinar trabalhadores em prevenção de violência (NR-1, Item 1.5.4.1). Implementar segurança interna (ex.: câmeras, se necessário).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Treinar trabalhadores em prevenção de violência (NR-1, Item 1.5.4.1). Implementar segurança interna (ex.: câmeras, se necessário).',
            ],
            // Protection
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir canal de denúncias confidencial com resposta em 5 dias.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir canal de denúncias confidencial com resposta em 5 dias.',
            ],
            // Prevention
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar queixas (< 1%) e incidentes (< 5%) mensalmente, com validação qualitativa.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === PROARTHazard::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == PROARTControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar queixas (< 1%) e incidentes (< 5%) mensalmente, com validação qualitativa.',
            ],
        ]);
    }
}
