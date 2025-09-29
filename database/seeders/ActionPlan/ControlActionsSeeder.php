<?php

namespace Database\Seeders\ActionPlan;

use App\Enums\ControlActionTypes;
use App\Enums\RiskTypes;
use App\Models\BaseControlAction;
use App\Models\ControlActionType;
use App\Models\Risk;
use Illuminate\Database\Seeder;

class ControlActionsSeeder extends Seeder
{
    public function run(): void
    {
        $risks = Risk::all();
        $controlActionTypes = ControlActionType::all();

        // organizational-rigidity
        BaseControlAction::insert([
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Redesenhar processos para aumentar autonomia dos trabalhadores, permitindo flexibilidade na execução de tarefas (ISO 45003, Cláusula 8.1.2). Exemplo: Implementar métodos ágeis com ciclos de feedback.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Redesenhar processos para aumentar autonomia dos trabalhadores, permitindo flexibilidade na execução de tarefas (ISO 45003, Cláusula 8.1.2). Exemplo: Implementar métodos ágeis com ciclos de feedback.',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Treinamentos para gestores sobre liderança participativa, enfatizando delegação e autonomia (NR-1, Item 1.5.4.1). Estabelecer políticas de tomada de decisão compartilhada.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Treinamentos para gestores sobre liderança participativa, enfatizando delegação e autonomia (NR-1, Item 1.5.4.1). Estabelecer políticas de tomada de decisão compartilhada.',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Criar canais de escuta ativa (ex.: ouvidoria interna) para relatos de rigidez, com resposta em até 7 dias (ISO 45003, Cláusula 10.2).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Criar canais de escuta ativa (ex.: ouvidoria interna) para relatos de rigidez, com resposta em até 7 dias (ISO 45003, Cláusula 10.2).',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Realizar pesquisas anuais de clima organizacional com perguntas específicas sobre autonomia (ex.: item 4 do questionário) para monitorar escores < 2,5 (Improvável).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ORGANIZATIONAL_RIGIDITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Realizar pesquisas anuais de clima organizacional com perguntas específicas sobre autonomia (ex.: item 4 do questionário) para monitorar escores < 2,5 (Improvável).',
            ],
        ]);

        // work-overload
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Revisar planejamento de tarefas para ajustar prazos e carga de trabalho, com base em análise de capacidade (ISO 45003, Cláusula 8.1.2). Exemplo: Limitar horas extras a < 10% do quadro (Improvável).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Revisar planejamento de tarefas para ajustar prazos e carga de trabalho, com base em análise de capacidade (ISO 45003, Cláusula 8.1.2). Exemplo: Limitar horas extras a < 10% do quadro (Improvável).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => ' Implementar política de limite de horas extras (máximo 2h/dia, CLT, Art. 59) e rodízio de tarefas para reduzir pressão (NR-1, Item 1.5.4.1). Treinar gestores para identificar sinais de sobrecarga.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => ' Implementar política de limite de horas extras (máximo 2h/dia, CLT, Art. 59) e rodízio de tarefas para reduzir pressão (NR-1, Item 1.5.4.1). Treinar gestores para identificar sinais de sobrecarga.',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Oferecer suporte psicológico via Programa de Assistência ao Empregado (PAE), com acesso a psicólogos (ISO 45003, Cláusula 8.1.3).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Oferecer suporte psicológico via Programa de Assistência ao Empregado (PAE), com acesso a psicólogos (ISO 45003, Cláusula 8.1.3).',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar indicadores (horas extras, absenteísmo, queixas) trimestralmente, com metas de redução para < 40% (NR-1, Item 1.5.5).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar indicadores (horas extras, absenteísmo, queixas) trimestralmente, com metas de redução para < 40% (NR-1, Item 1.5.5).',
            ],
        ]);

        // lack-of-resources
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Investir em equipamentos e infraestrutura adequados, com base em avaliações ergonômicas (NR-17, Item 17.3.3; ISO 45003, Cláusula 8.1.2).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Investir em equipamentos e infraestrutura adequados, com base em avaliações ergonômicas (NR-17, Item 17.3.3; ISO 45003, Cláusula 8.1.2).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Criar comitês de ergonomia com participação de trabalhadores para identificar necessidades de recursos (NR-1, Item 1.5.4.2). Estabelecer cronograma de manutenção preventiva.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Criar comitês de ergonomia com participação de trabalhadores para identificar necessidades de recursos (NR-1, Item 1.5.4.2). Estabelecer cronograma de manutenção preventiva.',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir acesso a ferramentas temporárias (ex.: aluguel de equipamentos) enquanto recursos permanentes não são adquiridos.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir acesso a ferramentas temporárias (ex.: aluguel de equipamentos) enquanto recursos permanentes não são adquiridos.',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir acesso a ferramentas temporárias (ex.: aluguel de equipamentos) enquanto recursos permanentes não são adquiridos.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RESOURCES->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir acesso a ferramentas temporárias (ex.: aluguel de equipamentos) enquanto recursos permanentes não são adquiridos.',
            ],
        ]);

        // unpredictability
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Implementar planos de comunicação para mudanças organizacionais, com consulta prévia aos trabalhadores (ISO 45003, Cláusula 8.1.2; item 15 do questionário).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Implementar planos de comunicação para mudanças organizacionais, com consulta prévia aos trabalhadores (ISO 45003, Cláusula 8.1.2; item 15 do questionário).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Estabelecer políticas de notificação de mudanças com antecedência mínima de 30 dias (NR-1, Item 1.5.4.2). Treinar gestores em gestão de mudanças.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Estabelecer políticas de notificação de mudanças com antecedência mínima de 30 dias (NR-1, Item 1.5.4.2). Treinar gestores em gestão de mudanças.',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Criar fóruns regulares para ouvir preocupações dos trabalhadores durante transições.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Criar fóruns regulares para ouvir preocupações dos trabalhadores durante transições.',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar queixas (< 5%) e absenteísmo (< 10%) relacionados a mudanças, com grupos focais para escores > 3,0.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::UNPREDICTABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar queixas (< 5%) e absenteísmo (< 10%) relacionados a mudanças, com grupos focais para escores > 3,0.',
            ],
        ]);

        // monotony
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar queixas (< 5%) e absenteísmo (< 10%) relacionados a mudanças, com grupos focais para escores > 3,0.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar queixas (< 5%) e absenteísmo (< 10%) relacionados a mudanças, com grupos focais para escores > 3,0.',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Oferecer treinamentos para diversificação de habilidades (NR-1, Item 1.5.4.1). Estabelecer pausas regulares (NR-17, Item 17.6.4).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Oferecer treinamentos para diversificação de habilidades (NR-1, Item 1.5.4.1). Estabelecer pausas regulares (NR-17, Item 17.6.4).',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Implementar atividades de integração (ex.: dinâmicas de grupo) para aumentar engajamento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Implementar atividades de integração (ex.: dinâmicas de grupo) para aumentar engajamento.',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar escores < 2,5 (item 2, 54) e queixas < 5% para evitar desmotivação.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MONOTONY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar escores < 2,5 (item 2, 54) e queixas < 5% para evitar desmotivação.',
            ],
        ]);

        // role-conflict
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Clarificar descrições de cargos e responsabilidades, com validação dos trabalhadores (ISO 45003, Cláusula 8.1.2).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Clarificar descrições de cargos e responsabilidades, com validação dos trabalhadores (ISO 45003, Cláusula 8.1.2).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Treinar gestores para emitir orientações consistentes (NR-1, Item 1.5.4.1). Criar fluxos de comunicação claros (ex.: organogramas).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Treinar gestores para emitir orientações consistentes (NR-1, Item 1.5.4.1). Criar fluxos de comunicação claros (ex.: organogramas).',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Estabelecer mediação interna para resolver conflitos de papéis.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Estabelecer mediação interna para resolver conflitos de papéis.',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar escores < 2,5 (itens 3, 5) e queixas < 5% via pesquisas trimestrais.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar escores < 2,5 (itens 3, 5) e queixas < 5% via pesquisas trimestrais.',
            ],
        ]);

        // --------------------------------------------------------------------------------------

        // individualistic-management
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Promover cultura colaborativa com tomada de decisão participativa (ISO 45003, Cláusula 8.1.2; itens 17, 23–25, 27, 29–30).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Promover cultura colaborativa com tomada de decisão participativa (ISO 45003, Cláusula 8.1.2; itens 17, 23–25, 27, 29–30).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Treinar gestores em liderança colaborativa (NR-1, Item 1.5.4.1). Estabelecer comitês de decisão com representantes dos trabalhadores.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Treinar gestores em liderança colaborativa (NR-1, Item 1.5.4.1). Estabelecer comitês de decisão com representantes dos trabalhadores.',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Criar canais de denúncia anônima para relatar práticas individualistas (ISO 45003, Cláusula 10.2).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Criar canais de denúncia anônima para relatar práticas individualistas (ISO 45003, Cláusula 10.2).',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar rotatividade (< 10%) e queixas (< 5%) trimestralmente.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::INDIVIDUALISTIC_MANAGEMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar rotatividade (< 10%) e queixas (< 5%) trimestralmente.',
            ],
        ]);

        // lack-of-recognition
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Implementar programas de reconhecimento (ex.: premiações por mérito) baseados em critérios transparentes (ISO 45003, Cláusula 8.1.2; itens 18, 20, 22, 26).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Implementar programas de reconhecimento (ex.: premiações por mérito) baseados em critérios transparentes (ISO 45003, Cláusula 8.1.2; itens 18, 20, 22, 26).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Treinar gestores para elogiar contribuições (NR-1, Item 1.5.4.1). Estabelecer feedback mensal.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Treinar gestores para elogiar contribuições (NR-1, Item 1.5.4.1). Estabelecer feedback mensal.',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Criar espaços para feedback dos trabalhadores sobre reconhecimento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Criar espaços para feedback dos trabalhadores sobre reconhecimento.',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar escores < 2,5 e queixas < 5% via pesquisas anuais.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_RECOGNITION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar escores < 2,5 e queixas < 5% via pesquisas anuais.',
            ],
        ]);

        // management-conflicts
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Promover comunicação aberta entre gestores e subordinados (ISO 45003, Cláusula 8.1.2; itens 16, 36).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Promover comunicação aberta entre gestores e subordinados (ISO 45003, Cláusula 8.1.2; itens 16, 36).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Implementar treinamentos de resolução de conflitos (NR-1, Item 1.5.4.1). Criar política de mediação interna.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Implementar treinamentos de resolução de conflitos (NR-1, Item 1.5.4.1). Criar política de mediação interna.',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir canal de denúncias anônimo com resposta em 7 dias (ISO 45003, Cláusula 10.2).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir canal de denúncias anônimo com resposta em 7 dias (ISO 45003, Cláusula 10.2).',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar rotatividade (< 10%) e queixas (< 5%) trimestralmente.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MANAGEMENT_CONFLICTS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar rotatividade (< 10%) e queixas (< 5%) trimestralmente.',
            ],
        ]);

        // lack-of-managerial-support
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Fomentar suporte gerencial via políticas de portas abertas e mentorias (ISO 45003, Cláusula 8.1.2; itens 19, 21, 52).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Fomentar suporte gerencial via políticas de portas abertas e mentorias (ISO 45003, Cláusula 8.1.2; itens 19, 21, 52).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Treinar gestores em apoio psicossocial (NR-1, Item 1.5.4.1). Criar redes de apoio entre colegas.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Treinar gestores em apoio psicossocial (NR-1, Item 1.5.4.1). Criar redes de apoio entre colegas.',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Oferecer acesso a PAE para suporte emocional.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Oferecer acesso a PAE para suporte emocional.',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar escores < 2,5 e queixas < 5% via pesquisas semestrais.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::LACK_OF_MANAGERIAL_SUPPORT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar escores < 2,5 e queixas < 5% via pesquisas semestrais.',
            ],
        ]);


        // perceived-injustice
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Estabelecer critérios transparentes para promoções e avaliações (ISO 45003, Cláusula 8.1.2; itens 28, 38).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Estabelecer critérios transparentes para promoções e avaliações (ISO 45003, Cláusula 8.1.2; itens 28, 38).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Criar comitês de ética para revisar decisões (NR-1, Item 1.5.4.2). Treinar gestores em imparcialidade.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Criar comitês de ética para revisar decisões (NR-1, Item 1.5.4.2). Treinar gestores em imparcialidade.',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir canal de denúncias anônimo para relatos de injustiça.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir canal de denúncias anônimo para relatos de injustiça.',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar queixas (< 5%) e rotatividade (< 10%) trimestralmente.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PERCEIVED_INJUSTICE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar queixas (< 5%) e rotatividade (< 10%) trimestralmente.',
            ],
        ]);

        // excessive-management-pressure
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Revisar metas para torná-las realistas, com consulta aos trabalhadores (ISO 45003, Cláusula 8.1.2; itens 31, 32).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Revisar metas para torná-las realistas, com consulta aos trabalhadores (ISO 45003, Cláusula 8.1.2; itens 31, 32).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Treinar gestores em liderança motivacional, evitando críticas injustas (NR-1, Item 1.5.4.1). Limitar metas inatingíveis.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Treinar gestores em liderança motivacional, evitando críticas injustas (NR-1, Item 1.5.4.1). Limitar metas inatingíveis.',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Oferecer suporte psicológico via PAE para trabalhadores sob pressão.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Oferecer suporte psicológico via PAE para trabalhadores sob pressão.',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar absenteísmo (< 25%) e queixas (< 5%) trimestralmente.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EXCESSIVE_MANAGEMENT_PRESSURE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar absenteísmo (< 25%) e queixas (< 5%) trimestralmente.',
            ],
        ]);

        // --------------------------------------------------------------------------------------

        // emotional-exhaustion
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Reduzir carga de trabalho e horas extras (< 10%) via planejamento (ISO 45003, Cláusula 8.1.2; itens 37, 50, 72).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Reduzir carga de trabalho e horas extras (< 10%) via planejamento (ISO 45003, Cláusula 8.1.2; itens 37, 50, 72).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Implementar programas de bem-estar (ex.: mindfulness, NR-1, Item 1.5.4.1). Limitar turnos prolongados.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Implementar programas de bem-estar (ex.: mindfulness, NR-1, Item 1.5.4.1). Limitar turnos prolongados.',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Oferecer acesso imediato a PAE com psicólogos.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Oferecer acesso imediato a PAE com psicólogos.',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar absenteísmo (< 40%) e afastamentos (< 25%) trimestralmente.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::EMOTIONAL_EXHAUSTION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar absenteísmo (< 40%) e afastamentos (< 25%) trimestralmente.',
            ],
        ]);

        // anxiety-or-stress
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Identificar e mitigar fontes de estresse (ex.: prazos irreais) via consultas participativas (ISO 45003, Cláusula 8.1.2; itens 46, 51).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Identificar e mitigar fontes de estresse (ex.: prazos irreais) via consultas participativas (ISO 45003, Cláusula 8.1.2; itens 46, 51).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Oferecer workshops de gestão de estresse (NR-1, Item 1.5.4.1). Estabelecer pausas regulares.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Oferecer workshops de gestão de estresse (NR-1, Item 1.5.4.1). Estabelecer pausas regulares.',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir acesso a suporte psicológico confidencial.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir acesso a suporte psicológico confidencial.',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar escores < 2,5 e queixas < 5% semestralmente.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::ANXIETY_OR_STRESS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar escores < 2,5 e queixas < 5% semestralmente.',
            ],
        ]);

        // social-isolation
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Promover integração via atividades de equipe (ISO 45003, Cláusula 8.1.2; itens 39, 47).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Promover integração via atividades de equipe (ISO 45003, Cláusula 8.1.2; itens 39, 47).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Treinar gestores para identificar sinais de exclusão (NR-1, Item 1.5.4.1). Criar redes de apoio entre colegas.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Treinar gestores para identificar sinais de exclusão (NR-1, Item 1.5.4.1). Criar redes de apoio entre colegas.',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir canal de denúncias para relatos de exclusão.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir canal de denúncias para relatos de exclusão.',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar queixas (< 5%) e absenteísmo (< 25%) trimestralmente.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar queixas (< 5%) e absenteísmo (< 25%) trimestralmente.',
            ],
        ]);

        // frustration-or-demotivation
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Alinhar tarefas com propósito organizacional (ISO 45003, Cláusula 8.1.2; itens 55–59).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Alinhar tarefas com propósito organizacional (ISO 45003, Cláusula 8.1.2; itens 55–59).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Oferecer treinamentos de desenvolvimento pessoal (NR-1, Item 1.5.4.1). Criar planos de carreira claros.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Oferecer treinamentos de desenvolvimento pessoal (NR-1, Item 1.5.4.1). Criar planos de carreira claros.',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Oferecer suporte psicológico para desmotivação.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Oferecer suporte psicológico para desmotivação.',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar escores < 2,5 e rotatividade (< 25%) anualmente.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FRUSTRATION_OR_DEMOTIVATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar escores < 2,5 e rotatividade (< 25%) anualmente.',
            ],
        ]);

        // irritability
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Mitigar conflitos interpessoais via mediação (ISO 45003, Cláusula 8.1.2; item 46).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Mitigar conflitos interpessoais via mediação (ISO 45003, Cláusula 8.1.2; item 46).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Treinar equipes em comunicação não violenta (NR-1, Item 1.5.4.1).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Treinar equipes em comunicação não violenta (NR-1, Item 1.5.4.1).',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir canal de denúncias para tensões interpessoais.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir canal de denúncias para tensões interpessoais.',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar queixas (< 5%) e absenteísmo (< 25%) trimestralmente.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::IRRITABILITY->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar queixas (< 5%) e absenteísmo (< 25%) trimestralmente.',
            ],
        ]);

        // difficulty-concentrating
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Reduzir distrações ambientais (ex.: ruído, NR-17, Item 17.5) e sobrecarga cognitiva (ISO 45003, Cláusula 8.1.2).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Reduzir distrações ambientais (ex.: ruído, NR-17, Item 17.5) e sobrecarga cognitiva (ISO 45003, Cláusula 8.1.2).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Implementar pausas cognitivas (NR-1, Item 1.5.4.1). Oferecer treinamentos de foco.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Implementar pausas cognitivas (NR-1, Item 1.5.4.1). Oferecer treinamentos de foco.',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Oferecer suporte psicológico para estresse cognitivo.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Oferecer suporte psicológico para estresse cognitivo.',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar escores < 2,5 e queixas < 5% semestralmente.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DIFFICULTY_CONCENTRATING->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar escores < 2,5 e queixas < 5% semestralmente.',
            ],
        ]);

        // --------------------------------------------------------------------------------------

        // physical-damage
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Implementar programas ergonômicos para prevenir lesões (NR-17, Item 17.3; ISO 45003, Cláusula 8.1.2; itens 63, 64, 66, 69).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Implementar programas ergonômicos para prevenir lesões (NR-17, Item 17.3; ISO 45003, Cláusula 8.1.2; itens 63, 64, 66, 69).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Realizar avaliações ergonômicas trimestrais (NR-1, Item 1.5.4.1). Limitar posturas forçadas.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Realizar avaliações ergonômicas trimestrais (NR-1, Item 1.5.4.1). Limitar posturas forçadas.',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Fornecer EPIs e ajustes ergonômicos individualizados.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Fornecer EPIs e ajustes ergonômicos individualizados.',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar acidentes (< 10%) e queixas (< 5%) semestralmente.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PHYSICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar acidentes (< 10%) e queixas (< 5%) semestralmente.',
            ],
        ]);

        // psychosological-damage
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Mitigar fontes de estresse (ex.: assédio, sobrecarga) via políticas preventivas (ISO 45003, Cláusula 8.1.2; itens 48, 49).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Mitigar fontes de estresse (ex.: assédio, sobrecarga) via políticas preventivas (ISO 45003, Cláusula 8.1.2; itens 48, 49).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Garantir acesso a PAE com psicólogos (NR-1, Item 1.5.4.1). Treinar gestores para identificar sinais de depressão.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Garantir acesso a PAE com psicólogos (NR-1, Item 1.5.4.1). Treinar gestores para identificar sinais de depressão.',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Criar canal de denúncias confidencial com resposta em 7 dias.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Criar canal de denúncias confidencial com resposta em 7 dias.',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar afastamentos (< 25%) e queixas (< 5%) trimestralmente.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOLOGICAL_DAMAGE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar afastamentos (< 25%) e queixas (< 5%) trimestralmente.',
            ],
        ]);

        // frequent-absenteeism
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Revisar condições de trabalho para reduzir riscos psicossociais (ISO 45003, Cláusula 8.1.2; itens 60, 61).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Revisar condições de trabalho para reduzir riscos psicossociais (ISO 45003, Cláusula 8.1.2; itens 60, 61).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Implementar programas de retorno ao trabalho com apoio psicológico (NR-1, Item 1.5.4.1).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Implementar programas de retorno ao trabalho com apoio psicológico (NR-1, Item 1.5.4.1).',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir suporte médico e psicológico para trabalhadores afastados.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir suporte médico e psicológico para trabalhadores afastados.',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar afastamentos (< 10%) e absenteísmo (< 25%) trimestralmente.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::FREQUENT_ABSENTEEISM->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar afastamentos (< 10%) e absenteísmo (< 25%) trimestralmente.',
            ],
        ]);

        // sleep-disorders
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Regular turnos para evitar jornadas noturnas prolongadas (NR-17, Item 17.6; ISO 45003, Cláusula 8.1.2; item 65).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Regular turnos para evitar jornadas noturnas prolongadas (NR-17, Item 17.6; ISO 45003, Cláusula 8.1.2; item 65).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Oferecer workshops sobre higiene do sono (NR-1, Item 1.5.4.1).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Oferecer workshops sobre higiene do sono (NR-1, Item 1.5.4.1).',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir acesso a suporte médico para insônia.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir acesso a suporte médico para insônia.',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar absenteísmo (< 25%) e queixas (< 5%) semestralmente.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SLEEP_DISORDERS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar absenteísmo (< 25%) e queixas (< 5%) semestralmente.',
            ],
        ]);

        // psychossomatic-problems
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Mitigar estresse via redução de carga de trabalho (ISO 45003, Cláusula 8.1.2; itens 62, 67, 68).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Mitigar estresse via redução de carga de trabalho (ISO 45003, Cláusula 8.1.2; itens 62, 67, 68).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Oferecer programas de bem-estar físico e mental (NR-1, Item 1.5.4.1).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Oferecer programas de bem-estar físico e mental (NR-1, Item 1.5.4.1).',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir acesso a médicos para sintomas psicossomáticos.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir acesso a médicos para sintomas psicossomáticos.',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar absenteísmo (< 25%) e afastamentos (< 10%) trimestralmente.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::PSYCHOSOMATIC_PROBLEMS->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar absenteísmo (< 25%) e afastamentos (< 10%) trimestralmente.',
            ],
        ]);

        // deterioration-of-personal-life
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Implementar políticas de equilíbrio trabalho-vida (ex.: home office, horários flexíveis, ISO 45003, Cláusula 8.1.2; itens 70, 71).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Implementar políticas de equilíbrio trabalho-vida (ex.: home office, horários flexíveis, ISO 45003, Cláusula 8.1.2; itens 70, 71).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Limitar horas extras (< 10%, NR-1, Item 1.5.4.1). Oferecer workshops de gestão de tempo.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Limitar horas extras (< 10%, NR-1, Item 1.5.4.1). Oferecer workshops de gestão de tempo.',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir acesso a suporte psicológico familiar.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir acesso a suporte psicológico familiar.',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar horas extras (< 10%) e queixas (< 5%) trimestralmente.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DETERIORATION_OF_PERSONAL_LIFE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar horas extras (< 10%) e queixas (< 5%) trimestralmente.',
            ],
        ]);


        // --------------------------------------------------------------------------------------

        // moral-harassment
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Implementar política de tolerância zero ao assédio moral, com sanções claras (ISO 45003, Cláusula 8.1.2; itens 31, 32, 39).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Implementar política de tolerância zero ao assédio moral, com sanções claras (ISO 45003, Cláusula 8.1.2; itens 31, 32, 39).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Treinar gestores e trabalhadores em identificação de assédio moral (NR-1, Item 1.5.4.1). Criar comitê de ética para investigar denúncias.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Treinar gestores e trabalhadores em identificação de assédio moral (NR-1, Item 1.5.4.1). Criar comitê de ética para investigar denúncias.',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir canal de denúncias anônimo com resposta em 7 dias (ISO 45003, Cláusula 10.2).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir canal de denúncias anônimo com resposta em 7 dias (ISO 45003, Cláusula 10.2).',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar queixas (< 5%) e absenteísmo (< 25%) trimestralmente, com grupos focais para escores > 3,5.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar queixas (< 5%) e absenteísmo (< 25%) trimestralmente, com grupos focais para escores > 3,5.',
            ],
        ]);

        // sexual-harassment
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Adotar política de tolerância zero ao assédio sexual, com medidas disciplinares imediatas (Lei nº 14.457/2022; ISO 45003, Cláusula 8.1.2; itens 40–42).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Adotar política de tolerância zero ao assédio sexual, com medidas disciplinares imediatas (Lei nº 14.457/2022; ISO 45003, Cláusula 8.1.2; itens 40–42).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Realizar treinamentos anuais obrigatórios sobre prevenção de assédio sexual (Lei nº 14.457/2022, Art. 23). Criar comitê de conformidade para investigação.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Realizar treinamentos anuais obrigatórios sobre prevenção de assédio sexual (Lei nº 14.457/2022, Art. 23). Criar comitê de conformidade para investigação.',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir canal de denúncias confidencial com resposta em 5 dias (ISO 45003, Cláusula 10.2).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir canal de denúncias confidencial com resposta em 5 dias (ISO 45003, Cláusula 10.2).',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar queixas (< 1%) e afastamentos (< 10%) mensalmente, com validação qualitativa para escores > 3,0.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar queixas (< 1%) e afastamentos (< 10%) mensalmente, com validação qualitativa para escores > 3,0.',
            ],
        ]);

        // discrimination
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Implementar políticas de diversidade e inclusão, com critérios objetivos para promoções (ISO 45003, Cláusula 8.1.2; itens 33, 34; Decreto nº 62.150/1968).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Implementar políticas de diversidade e inclusão, com critérios objetivos para promoções (ISO 45003, Cláusula 8.1.2; itens 33, 34; Decreto nº 62.150/1968).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Implementar políticas de diversidade e inclusão, com critérios objetivos para promoções (ISO 45003, Cláusula 8.1.2; itens 33, 34; Decreto nº 62.150/1968).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Implementar políticas de diversidade e inclusão, com critérios objetivos para promoções (ISO 45003, Cláusula 8.1.2; itens 33, 34; Decreto nº 62.150/1968).',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir canal de denúncias para discriminação, com resposta em 7 dias.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir canal de denúncias para discriminação, com resposta em 7 dias.',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar queixas (< 5%) e desvantagem injustificada (< 5%) semestralmente.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::DISCRIMINATION->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar queixas (< 5%) e desvantagem injustificada (< 5%) semestralmente.',
            ],
        ]);

        // other-forms-of-violence
        BaseControlAction::insert([
            // Reduction
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 3,
                'content' => 'Estabelecer política de tolerância zero à violência, com sanções severas (ISO 45003, Cláusula 8.1.2; itens 43–45; Convenção 190 OIT).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::REDUCTION->value)->id,
                'gravity' => 4,
                'content' => 'Estabelecer política de tolerância zero à violência, com sanções severas (ISO 45003, Cláusula 8.1.2; itens 43–45; Convenção 190 OIT).',
            ],
            // Administrative
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 3,
                'content' => 'Treinar trabalhadores em prevenção de violência (NR-1, Item 1.5.4.1). Implementar segurança interna (ex.: câmeras, se necessário).',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::ADMINISTRATIVE->value)->id,
                'gravity' => 4,
                'content' => 'Treinar trabalhadores em prevenção de violência (NR-1, Item 1.5.4.1). Implementar segurança interna (ex.: câmeras, se necessário).',
            ],
            // Protection
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 3,
                'content' => 'Garantir canal de denúncias confidencial com resposta em 5 dias.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PROTECTION->value)->id,
                'gravity' => 4,
                'content' => 'Garantir canal de denúncias confidencial com resposta em 5 dias.',
            ],
            // Prevention
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 1,
                'content' => 'Não exige ação imediata',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 2,
                'content' => 'Manter controle e monitoramento.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 3,
                'content' => 'Monitorar queixas (< 1%) e incidentes (< 5%) mensalmente, com validação qualitativa.',
            ],
            [
                'risk_id' => $risks->first(fn($risk) => $risk->type === RiskTypes::OTHER_FORMS_OF_VIOLENCE->value)->id,
                'control_action_type_id' => $controlActionTypes->first(fn($type) => $type->type == ControlActionTypes::PREVENTION->value)->id,
                'gravity' => 4,
                'content' => 'Monitorar queixas (< 1%) e incidentes (< 5%) mensalmente, com validação qualitativa.',
            ],
        ]);
    }
}
