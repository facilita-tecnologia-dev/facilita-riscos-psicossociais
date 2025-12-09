<?php

namespace Database\Seeders\ActionPlan;

use App\Enums\Campaign\MetodologyType;
use App\Enums\Psychosocial\HSE\HSEHazard;
use App\Models\BaseControlAction;
use App\Models\Hazard;
use Illuminate\Database\Seeder;

class HSEControlActionsSeeder extends Seeder
{
    public function run(): void
    {
        $risks = Hazard::whereHas('collection', fn($collection) => $collection->where('key', MetodologyType::HSE->value))->get();

        // work-overload
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Ajustar prazos e distribuir tarefas conforme a capacidade da equipe.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Capacitar gestores em gestão de carga de trabalho.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Atendimento psicológico profissional para trabalhadores em sobrecarga.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Analisar resultados de pesquisa de clima organizacional para identificar excesso de pressão.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Ajustar prazos e distribuir tarefas conforme a capacidade da equipe.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Capacitar gestores em gestão de carga de trabalho.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Atendimento psicológico profissional para trabalhadores em sobrecarga.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::WORK_OVERLOAD->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Analisar resultados de pesquisa de clima organizacional para identificar excesso de pressão.',
            ],
        ]);

        // deadline-pressure
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DEADLINE_PRESSURE->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DEADLINE_PRESSURE->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DEADLINE_PRESSURE->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DEADLINE_PRESSURE->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Ajustar prazos e distribuir tarefas conforme a capacidade da equipe.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DEADLINE_PRESSURE->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Capacitar gestores em gestão de carga de trabalho.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DEADLINE_PRESSURE->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Atendimento psicológico profissional para trabalhadores em sobrecarga.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DEADLINE_PRESSURE->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Analisar resultados de pesquisa de clima organizacional para identificar excesso de pressão.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DEADLINE_PRESSURE->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Ajustar prazos e distribuir tarefas conforme a capacidade da equipe.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DEADLINE_PRESSURE->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Capacitar gestores em gestão de carga de trabalho.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DEADLINE_PRESSURE->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Atendimento psicológico profissional para trabalhadores em sobrecarga.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DEADLINE_PRESSURE->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Analisar resultados de pesquisa de clima organizacional para identificar excesso de pressão.',
            ],
        ]);

        // long-working-hours
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LONG_WORKING_HOURS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LONG_WORKING_HOURS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LONG_WORKING_HOURS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LONG_WORKING_HOURS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Ajustar escalas para evitar jornadas excessivas.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LONG_WORKING_HOURS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Treinar trabalhadores e gestores em boas práticas de organização do sono.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LONG_WORKING_HOURS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Atendimento médico e psicológico profissional em casos de fadiga.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LONG_WORKING_HOURS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Usar pesquisa de clima para verificar percepções de cansaço e impacto das jornadas.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LONG_WORKING_HOURS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Ajustar escalas para evitar jornadas excessivas.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LONG_WORKING_HOURS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Treinar trabalhadores e gestores em boas práticas de organização do sono.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LONG_WORKING_HOURS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Atendimento médico e psicológico profissional em casos de fadiga.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LONG_WORKING_HOURS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Usar pesquisa de clima para verificar percepções de cansaço e impacto das jornadas.',
            ],
        ]);

        // constant-interruptions
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::CONSTANT_INTERRUPTIONS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::CONSTANT_INTERRUPTIONS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::CONSTANT_INTERRUPTIONS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::CONSTANT_INTERRUPTIONS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Criar períodos de trabalho sem interrupções para atividades críticas.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::CONSTANT_INTERRUPTIONS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Treinamentos sobre foco e gestão de tempo.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::CONSTANT_INTERRUPTIONS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Atendimento psicológico profissional em casos de estresse cognitivo.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::CONSTANT_INTERRUPTIONS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Acompanhar percepção em pesquisa de clima organizacional.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::CONSTANT_INTERRUPTIONS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Criar períodos de trabalho sem interrupções para atividades críticas.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::CONSTANT_INTERRUPTIONS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Treinamentos sobre foco e gestão de tempo.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::CONSTANT_INTERRUPTIONS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Atendimento psicológico profissional em casos de estresse cognitivo.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::CONSTANT_INTERRUPTIONS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Acompanhar percepção em pesquisa de clima organizacional.',
            ],
        ]);

        // insufficient-resources
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INSUFFICIENT_RESOURCES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INSUFFICIENT_RESOURCES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INSUFFICIENT_RESOURCES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INSUFFICIENT_RESOURCES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Garantir aquisição e manutenção de equipamentos adequados.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INSUFFICIENT_RESOURCES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Realizar análises ergonômicas abrangentes para identificar recursos necessários.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INSUFFICIENT_RESOURCES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Soluções provisórias até implementação definitiva.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INSUFFICIENT_RESOURCES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Incluir indicadores de adequação de recursos em pesquisa de clima.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INSUFFICIENT_RESOURCES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Garantir aquisição e manutenção de equipamentos adequados.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INSUFFICIENT_RESOURCES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Realizar análises ergonômicas abrangentes para identificar recursos necessários.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INSUFFICIENT_RESOURCES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Soluções provisórias até implementação definitiva.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INSUFFICIENT_RESOURCES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Incluir indicadores de adequação de recursos em pesquisa de clima.',
            ],
        ]);
        
        // high-emotional-demands
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::HIGH_EMOTIONAL_DEMANDS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::HIGH_EMOTIONAL_DEMANDS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::HIGH_EMOTIONAL_DEMANDS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::HIGH_EMOTIONAL_DEMANDS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Estabelecer metas compatíveis com a capacidade da equipe.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::HIGH_EMOTIONAL_DEMANDS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Treinar equipes em manejo de situações de estresse e atendimento ao público.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::HIGH_EMOTIONAL_DEMANDS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Atendimento psicológico profissional após eventos críticos.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::HIGH_EMOTIONAL_DEMANDS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Monitorar relatos via canal de denúncias.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::HIGH_EMOTIONAL_DEMANDS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Estabelecer metas compatíveis com a capacidade da equipe.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::HIGH_EMOTIONAL_DEMANDS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Treinar equipes em manejo de situações de estresse e atendimento ao público.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::HIGH_EMOTIONAL_DEMANDS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Atendimento psicológico profissional após eventos críticos.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::HIGH_EMOTIONAL_DEMANDS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Monitorar relatos via canal de denúncias.',
            ],
        ]);
 
        // low-autonomy
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOW_AUTONOMY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOW_AUTONOMY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOW_AUTONOMY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOW_AUTONOMY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Revisar processos para ampliar autonomia nas atividades.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOW_AUTONOMY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Treinamento de gestores em liderança participativa.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOW_AUTONOMY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Canal de denúncias anônimo com retorno em até 7 dias úteis.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOW_AUTONOMY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Verificação em pesquisa de clima sobre percepção de autonomia.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOW_AUTONOMY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Revisar processos para ampliar autonomia nas atividades.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOW_AUTONOMY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Treinamento de gestores em liderança participativa.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOW_AUTONOMY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Canal de denúncias anônimo com retorno em até 7 dias úteis.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOW_AUTONOMY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Verificação em pesquisa de clima sobre percepção de autonomia.',
            ],
        ]);
                        
        // micromanagement
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::MICROMANAGEMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::MICROMANAGEMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::MICROMANAGEMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::MICROMANAGEMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Simplificar e padronizar relatórios e indicadores de desempenho.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::MICROMANAGEMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Capacitar gestores em gestão por resultados e comunicação clara.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::MICROMANAGEMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Canal de denúncias anônimo com garantia de anonimato.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::MICROMANAGEMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Acompanhar percepções sobre gestão em pesquisa de clima.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::MICROMANAGEMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Simplificar e padronizar relatórios e indicadores de desempenho.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::MICROMANAGEMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Capacitar gestores em gestão por resultados e comunicação clara.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::MICROMANAGEMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Canal de denúncias anônimo com garantia de anonimato.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::MICROMANAGEMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Acompanhar percepções sobre gestão em pesquisa de clima.',
            ],
        ]);
            
        // low-schedule-flexibility
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOW_SCHEDULE_FLEXIBILITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOW_SCHEDULE_FLEXIBILITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOW_SCHEDULE_FLEXIBILITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOW_SCHEDULE_FLEXIBILITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Implementar políticas de flexibilização quando compatíveis com a função.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOW_SCHEDULE_FLEXIBILITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Treinamento de gestores em suporte psicossocial.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOW_SCHEDULE_FLEXIBILITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Treinamento de gestores em suporte psicossocial.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOW_SCHEDULE_FLEXIBILITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Avaliar impacto em pesquisa de clima organizacional.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOW_SCHEDULE_FLEXIBILITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Implementar políticas de flexibilização quando compatíveis com a função.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOW_SCHEDULE_FLEXIBILITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Treinamento de gestores em suporte psicossocial.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOW_SCHEDULE_FLEXIBILITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Treinamento de gestores em suporte psicossocial.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOW_SCHEDULE_FLEXIBILITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Avaliar impacto em pesquisa de clima organizacional.',
            ],
        ]);
                                
        // rigid-procedures (todo)
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RIGID_PROCEDURES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RIGID_PROCEDURES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RIGID_PROCEDURES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RIGID_PROCEDURES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'aaaa',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RIGID_PROCEDURES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'bbbb',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RIGID_PROCEDURES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'ccccc',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RIGID_PROCEDURES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'dddd',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RIGID_PROCEDURES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'aaaa',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RIGID_PROCEDURES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'bbbb',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RIGID_PROCEDURES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'ccccc',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RIGID_PROCEDURES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'dddd',
            ],
        ]);
                                
        // lack-of-feedback
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LACK_OF_FEEDBACK->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LACK_OF_FEEDBACK->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LACK_OF_FEEDBACK->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LACK_OF_FEEDBACK->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Criar programa formal de reconhecimento dos trabalhadores.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LACK_OF_FEEDBACK->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Treinar gestores em feedback construtivo.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LACK_OF_FEEDBACK->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Espaços formais de feedback ascendente.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LACK_OF_FEEDBACK->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Verificar reconhecimento em pesquisa de clima.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LACK_OF_FEEDBACK->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Criar programa formal de reconhecimento dos trabalhadores.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LACK_OF_FEEDBACK->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Treinar gestores em feedback construtivo.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LACK_OF_FEEDBACK->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Espaços formais de feedback ascendente.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LACK_OF_FEEDBACK->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Verificar reconhecimento em pesquisa de clima.',
            ],
        ]);
                     
        // toxic-leadership
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::TOXIC_LEADERSHIP->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::TOXIC_LEADERSHIP->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::TOXIC_LEADERSHIP->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::TOXIC_LEADERSHIP->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Estabelecer políticas claras de promoção e avaliação.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::TOXIC_LEADERSHIP->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Treinamentos de ética e mediação de conflitos.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::TOXIC_LEADERSHIP->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Canal de denúncias anônimo com resposta em até 7 dias úteis.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::TOXIC_LEADERSHIP->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Avaliar percepção de justiça em pesquisa de clima.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::TOXIC_LEADERSHIP->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Estabelecer políticas claras de promoção e avaliação.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::TOXIC_LEADERSHIP->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Treinamentos de ética e mediação de conflitos.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::TOXIC_LEADERSHIP->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Canal de denúncias anônimo com resposta em até 7 dias úteis.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::TOXIC_LEADERSHIP->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Avaliar percepção de justiça em pesquisa de clima.',
            ],
        ]);
                                        
        // insufficient-training
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INSUFFICIENT_TRAINING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INSUFFICIENT_TRAINING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INSUFFICIENT_TRAINING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INSUFFICIENT_TRAINING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Garantir treinamentos prévios a novas atividades.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INSUFFICIENT_TRAINING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Plano de capacitação por função.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INSUFFICIENT_TRAINING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Atendimento psicológico profissional em casos de insegurança.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INSUFFICIENT_TRAINING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Monitorar impacto dos treinamentos em pesquisa de clima.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INSUFFICIENT_TRAINING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Garantir treinamentos prévios a novas atividades.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INSUFFICIENT_TRAINING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Plano de capacitação por função.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INSUFFICIENT_TRAINING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Atendimento psicológico profissional em casos de insegurança.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INSUFFICIENT_TRAINING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Monitorar impacto dos treinamentos em pesquisa de clima.',
            ],
        ]);
                                                
        // social-isolation
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Promover atividades de integração no ambiente de trabalho.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Treinar gestores para identificar exclusão.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Canal de denúncias anônimo com resposta garantida.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Acompanhar sensação de pertencimento em pesquisa de clima.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Promover atividades de integração no ambiente de trabalho.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Treinar gestores para identificar exclusão.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Canal de denúncias anônimo com resposta garantida.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::SOCIAL_ISOLATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Acompanhar sensação de pertencimento em pesquisa de clima.',
            ],
        ]);
                                                
        // chronic-team-conflicts
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::CHRONIC_TEAM_CONFLICTS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::CHRONIC_TEAM_CONFLICTS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::CHRONIC_TEAM_CONFLICTS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::CHRONIC_TEAM_CONFLICTS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Estabelecer pactos de convivência entre equipes.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::CHRONIC_TEAM_CONFLICTS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Treinamento em comunicação não violenta.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::CHRONIC_TEAM_CONFLICTS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Canal de denúncias anônimo com resposta em até 7 dias úteis.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::CHRONIC_TEAM_CONFLICTS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Pesquisa de clima para identificar incidência de conflitos.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::CHRONIC_TEAM_CONFLICTS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Estabelecer pactos de convivência entre equipes.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::CHRONIC_TEAM_CONFLICTS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Treinamento em comunicação não violenta.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::CHRONIC_TEAM_CONFLICTS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Canal de denúncias anônimo com resposta em até 7 dias úteis.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::CHRONIC_TEAM_CONFLICTS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Pesquisa de clima para identificar incidência de conflitos.',
            ],
        ]);
                                                        
        // moral-harassment
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Criar política de combate ao assédio e divulgar amplamente.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Treinamentos sobre assédio e conduta ética.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Canal de denúncias anônimo + atendimento psicológico profissional.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Usar pesquisa de clima para avaliar percepção de respeito no ambiente.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Criar política de combate ao assédio e divulgar amplamente.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Treinamentos sobre assédio e conduta ética.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Canal de denúncias anônimo + atendimento psicológico profissional.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::MORAL_HARASSMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Usar pesquisa de clima para avaliar percepção de respeito no ambiente.',
            ],
        ]);
                                                                
        // sexual-harassment
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Política clara contra assédio e violência no trabalho.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Treinamentos de conscientização para todos os empregados.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Treinamentos de conscientização para todos os empregados.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Monitorar percepções em pesquisa de clima.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Política clara contra assédio e violência no trabalho.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Treinamentos de conscientização para todos os empregados.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Treinamentos de conscientização para todos os empregados.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::SEXUAL_HARASSMENT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Monitorar percepções em pesquisa de clima.',
            ],
        ]);
                                                                
        // incivility
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INCIVILITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INCIVILITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INCIVILITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INCIVILITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Estabelecer pactos de convivência entre equipes.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INCIVILITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Treinamento em comunicação não violenta.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INCIVILITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Canal de denúncias anônimo com resposta em até 7 dias úteis.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INCIVILITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Pesquisa de clima para identificar incidência de conflitos.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INCIVILITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Estabelecer pactos de convivência entre equipes.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INCIVILITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Treinamento em comunicação não violenta.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INCIVILITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Canal de denúncias anônimo com resposta em até 7 dias úteis.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::INCIVILITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Pesquisa de clima para identificar incidência de conflitos.',
            ],
        ]);
                                                                        
        // discrimination (todo)
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Adotar política antidiscriminatória formal e cláusula de igualdade de oportunidades no regulamento interno',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Realizar treinamentos sobre diversidade e inclusão; revisar processos de recrutamento, promoção e avaliação de desempenho para eliminar vieses.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Canal de denúncias com anonimato garantido, com fluxo de apuração protegido por sigilo e sem retaliação.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Avaliar condições de inclusão física e de comunicação (ex.: acessibilidade, ergonomia de postos adaptados).',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Incluir indicadores de diversidade e percepção de justiça na pesquisa de clima organizacional; promover campanhas educativas anuais.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Adotar política antidiscriminatória formal e cláusula de igualdade de oportunidades no regulamento interno',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Realizar treinamentos sobre diversidade e inclusão; revisar processos de recrutamento, promoção e avaliação de desempenho para eliminar vieses.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Canal de denúncias com anonimato garantido, com fluxo de apuração protegido por sigilo e sem retaliação.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Incluir indicadores de diversidade e percepção de justiça na pesquisa de clima organizacional; promover campanhas educativas anuais.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::DISCRIMINATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Avaliar condições de inclusão física e de comunicação (ex.: acessibilidade, ergonomia de postos adaptados).',
            ],
        ]);
                                                                        
        // violence
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::VIOLENCE->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::VIOLENCE->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::VIOLENCE->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::VIOLENCE->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Política clara contra assédio e violência no trabalho.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::VIOLENCE->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Treinamentos de conscientização para todos os empregados.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::VIOLENCE->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Canal de denúncias anônimo com resposta ≤ 7 dias úteis + atendimento psicológico profissional.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::VIOLENCE->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Monitorar percepções em pesquisa de clima.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::VIOLENCE->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Política clara contra assédio e violência no trabalho.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::VIOLENCE->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Treinamentos de conscientização para todos os empregados.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::VIOLENCE->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Canal de denúncias anônimo com resposta ≤ 7 dias úteis + atendimento psicológico profissional.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::VIOLENCE->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Monitorar percepções em pesquisa de clima.',
            ],
        ]);
                                                                                
        // role-ambiguity
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::ROLE_AMBIGUITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::ROLE_AMBIGUITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::ROLE_AMBIGUITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::ROLE_AMBIGUITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Atualizar e divulgar descrições de cargos.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::ROLE_AMBIGUITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Treinamentos sobre funções e responsabilidades.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::ROLE_AMBIGUITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Mediação conduzida pelo RH.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::ROLE_AMBIGUITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Identificar clareza de papéis em pesquisa de clima.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::ROLE_AMBIGUITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Atualizar e divulgar descrições de cargos.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::ROLE_AMBIGUITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Treinamentos sobre funções e responsabilidades.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::ROLE_AMBIGUITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Mediação conduzida pelo RH.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::ROLE_AMBIGUITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Identificar clareza de papéis em pesquisa de clima.',
            ],
        ]);
                                                                                
        // role-conflict
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Atualizar e divulgar descrições de cargos.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Treinamentos sobre funções e responsabilidades.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Mediação conduzida pelo RH.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Identificar clareza de papéis em pesquisa de clima.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Atualizar e divulgar descrições de cargos.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Treinamentos sobre funções e responsabilidades.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Mediação conduzida pelo RH.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::ROLE_CONFLICT->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Identificar clareza de papéis em pesquisa de clima.',
            ],
        ]);
                                                                                        
        // responsibility-without-authority
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RESPONSIBILITY_WITHOUT_AUTHORITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RESPONSIBILITY_WITHOUT_AUTHORITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RESPONSIBILITY_WITHOUT_AUTHORITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RESPONSIBILITY_WITHOUT_AUTHORITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Formalizar delegação de responsabilidades nos documentos da função.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RESPONSIBILITY_WITHOUT_AUTHORITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Treinar gestores para orientar com clareza.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RESPONSIBILITY_WITHOUT_AUTHORITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Canal de escuta anônimo para impasses.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RESPONSIBILITY_WITHOUT_AUTHORITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Avaliar percepção em pesquisa de clima.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RESPONSIBILITY_WITHOUT_AUTHORITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Formalizar delegação de responsabilidades nos documentos da função.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RESPONSIBILITY_WITHOUT_AUTHORITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Treinar gestores para orientar com clareza.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RESPONSIBILITY_WITHOUT_AUTHORITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Canal de escuta anônimo para impasses.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RESPONSIBILITY_WITHOUT_AUTHORITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Avaliar percepção em pesquisa de clima.',
            ],
        ]);
                                                                                        
        // frequent-priority-changes
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::FREQUENT_PRIORITY_CHANGES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::FREQUENT_PRIORITY_CHANGES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::FREQUENT_PRIORITY_CHANGES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::FREQUENT_PRIORITY_CHANGES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Estabelecer prioridades por meio de planejamento definido.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::FREQUENT_PRIORITY_CHANGES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Criar comitê de priorização com representantes de setores.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::FREQUENT_PRIORITY_CHANGES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Espaço de feedback coletivo sobre mudanças.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::FREQUENT_PRIORITY_CHANGES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Acompanhar percepções sobre estabilidade em pesquisa de clima.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::FREQUENT_PRIORITY_CHANGES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Estabelecer prioridades por meio de planejamento definido.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::FREQUENT_PRIORITY_CHANGES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Criar comitê de priorização com representantes de setores.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::FREQUENT_PRIORITY_CHANGES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Espaço de feedback coletivo sobre mudanças.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::FREQUENT_PRIORITY_CHANGES->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Acompanhar percepções sobre estabilidade em pesquisa de clima.',
            ],
        ]);
                                                                                                
        // poor-change-communication
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::POOR_CHANGE_COMMUNICATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::POOR_CHANGE_COMMUNICATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::POOR_CHANGE_COMMUNICATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::POOR_CHANGE_COMMUNICATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Implementar plano de comunicação estruturado antes das mudanças.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::POOR_CHANGE_COMMUNICATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Treinamento sobre novos processos e tecnologias.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::POOR_CHANGE_COMMUNICATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Fóruns de escuta para trabalhadores.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::POOR_CHANGE_COMMUNICATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Avaliar percepção em pesquisa de clima organizacional.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::POOR_CHANGE_COMMUNICATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Implementar plano de comunicação estruturado antes das mudanças.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::POOR_CHANGE_COMMUNICATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Treinamento sobre novos processos e tecnologias.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::POOR_CHANGE_COMMUNICATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Fóruns de escuta para trabalhadores.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::POOR_CHANGE_COMMUNICATION->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Avaliar percepção em pesquisa de clima organizacional.',
            ],
        ]);
                                                                                                
        // job-insecurity
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::JOB_INSECURITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::JOB_INSECURITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::JOB_INSECURITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::JOB_INSECURITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Garantir comunicação transparente sobre impactos.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::JOB_INSECURITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Estabelecer critérios claros de gestão de mudanças.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::JOB_INSECURITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Atendimento psicológico profissional.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::JOB_INSECURITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Acompanhar confiança e engajamento em pesquisa de clima.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::JOB_INSECURITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Garantir comunicação transparente sobre impactos.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::JOB_INSECURITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Estabelecer critérios claros de gestão de mudanças.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::JOB_INSECURITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Atendimento psicológico profissional.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::JOB_INSECURITY->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Acompanhar confiança e engajamento em pesquisa de clima.',
            ],
        ]);
                                                                                                        
        // restructuring
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RESTRUCTURING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RESTRUCTURING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RESTRUCTURING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RESTRUCTURING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Garantir comunicação transparente sobre impactos.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RESTRUCTURING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Garantir comunicação transparente sobre impactos.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RESTRUCTURING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Atendimento psicológico profissional.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RESTRUCTURING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Acompanhar confiança e engajamento em pesquisa de clima.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RESTRUCTURING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Garantir comunicação transparente sobre impactos.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RESTRUCTURING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Garantir comunicação transparente sobre impactos.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RESTRUCTURING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Atendimento psicológico profissional.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::RESTRUCTURING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Acompanhar confiança e engajamento em pesquisa de clima.',
            ],
        ]);
                                                                                                        
        // new-technology-without-training
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::NEW_TECHNOLOGY_WITHOUT_TRAINING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::NEW_TECHNOLOGY_WITHOUT_TRAINING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::NEW_TECHNOLOGY_WITHOUT_TRAINING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::NEW_TECHNOLOGY_WITHOUT_TRAINING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Implementar plano de comunicação estruturado antes das mudanças.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::NEW_TECHNOLOGY_WITHOUT_TRAINING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Treinamento sobre novos processos e tecnologias.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::NEW_TECHNOLOGY_WITHOUT_TRAINING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Fóruns de escuta para trabalhadores.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::NEW_TECHNOLOGY_WITHOUT_TRAINING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Avaliar percepção em pesquisa de clima organizacional.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::NEW_TECHNOLOGY_WITHOUT_TRAINING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Implementar plano de comunicação estruturado antes das mudanças.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::NEW_TECHNOLOGY_WITHOUT_TRAINING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Treinamento sobre novos processos e tecnologias.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::NEW_TECHNOLOGY_WITHOUT_TRAINING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Fóruns de escuta para trabalhadores.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::NEW_TECHNOLOGY_WITHOUT_TRAINING->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Avaliar percepção em pesquisa de clima organizacional.',
            ],
        ]);
                                                                                       
        // loss-of-benefits
        BaseControlAction::insert([
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOSS_OF_BENEFITS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 1,
                'content' => 'Nenhuma ação necessária',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOSS_OF_BENEFITS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 2,
                'content' => 'Sem controle adicional necessário',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOSS_OF_BENEFITS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 3,
                'content' => 'Controle adicional se possível ou viável',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOSS_OF_BENEFITS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Garantir comunicação transparente sobre impactos.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOSS_OF_BENEFITS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Estabelecer critérios claros de gestão de mudanças.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOSS_OF_BENEFITS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Atendimento psicológico profissional.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOSS_OF_BENEFITS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 4,
                'content' => 'Acompanhar confiança e engajamento em pesquisa de clima.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOSS_OF_BENEFITS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Garantir comunicação transparente sobre impactos.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOSS_OF_BENEFITS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Estabelecer critérios claros de gestão de mudanças.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOSS_OF_BENEFITS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Atendimento psicológico profissional.',
            ],
            [
                'hazard_id' => $risks->first(fn($risk) => $risk->type === HSEHazard::LOSS_OF_BENEFITS->value)->id,
                'control_action_type_id' => null,
                'gravity' => 5,
                'content' => 'Acompanhar confiança e engajamento em pesquisa de clima.',
            ],
        ]);
    }
}
