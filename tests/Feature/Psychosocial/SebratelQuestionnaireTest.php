<?php

use App\Enums\Campaign\MetodologyType;
use App\Enums\Psychosocial\HSE\HSEGroup;
use App\Enums\Psychosocial\HSE\HSEOption;
use App\Enums\Psychosocial\PsychosocialQuestionnaire;
use App\Models\BaseCollection;
use App\Models\BaseQuestion;
use App\Models\BaseQuestionTranslation;
use App\Models\Campaign;
use App\Models\Company;
use App\Services\Psychosocial\HSERiskService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseTransactions::class);

/**
 * Replica a fórmula do blade do formulário para o valor armazenado de uma
 * resposta: questões `inverted` têm as opções espelhadas no momento da resposta.
 */
function storedAnswerValue(HSEOption $option, bool $inverted): int
{
    return $inverted ? (int) $option->inverted() : $option->value;
}

describe('coleção sb-based-on-hse', function () {
    it('existe com 35 questões nos mesmos grupos do HSE', function () {
        $collection = BaseCollection::firstWhere('key', MetodologyType::SB_BASED_ON_HSE->value);

        expect($collection)->not->toBeNull()
            ->and($collection->type->value)->toBe('psychosocial-risks');

        $byGroup = $collection->questions()->get()->groupBy('group')->map->count();

        expect($byGroup->toArray())->toBe([
            HSEGroup::CHANGE->value => 3,
            HSEGroup::CONTROL->value => 6,
            HSEGroup::DEMANDS->value => 8,
            HSEGroup::RELATIONSHIPS->value => 4,
            HSEGroup::ROLE->value => 5,
            HSEGroup::SUPPORT->value => 9,
        ]);
    });

    it('marca todas as questões como não invertidas', function () {
        $collection = BaseCollection::firstWhere('key', MetodologyType::SB_BASED_ON_HSE->value);

        expect($collection->questions()->where('inverted', true)->count())->toBe(0);
    });

    it('não tem perigos próprios (a avaliação usa os perigos do HSE)', function () {
        $collection = BaseCollection::firstWhere('key', MetodologyType::SB_BASED_ON_HSE->value);

        expect($collection->hazards()->count())->toBe(0);
    });

    it('tem tradução en/es/fr para as 35 questões', function () {
        $collection = BaseCollection::firstWhere('key', MetodologyType::SB_BASED_ON_HSE->value);
        $questionIds = $collection->questions()->pluck('id');

        foreach (['en', 'es', 'fr'] as $locale) {
            expect(BaseQuestionTranslation::whereIn('base_question_id', $questionIds)->where('locale', $locale)->count())
                ->toBe(35, "faltam traduções em {$locale}");
        }
    });
});

describe('Company: formulário vs. motor de avaliação', function () {
    it('empresa padrão responde o formulário da metodologia', function () {
        $company = Company::factory()->create([
            'psychosocial_collection_type' => MetodologyType::HSE->value,
            'psychosocial_questionnaire' => PsychosocialQuestionnaire::STANDARD,
        ]);

        expect($company->psychosocialCollection()->key)->toBe('hse')
            ->and($company->evaluationCollection()->key)->toBe('hse')
            ->and($company->usesHSE())->toBeTrue()
            ->and($company->usesSebratelQuestionnaire())->toBeFalse();
    });

    it('empresa Sebratel responde o formulário Sebratel mas avalia pelo HSE', function () {
        $company = Company::factory()->create([
            'psychosocial_collection_type' => MetodologyType::HSE->value,
            'psychosocial_questionnaire' => PsychosocialQuestionnaire::SB_BASED_ON_HSE,
        ]);

        expect($company->psychosocialCollection()->key)->toBe('sb-based-on-hse')
            ->and($company->evaluationCollection()->key)->toBe('hse')
            ->and($company->usesHSE())->toBeTrue()
            ->and($company->usesSebratelQuestionnaire())->toBeTrue();

        // os perigos vêm da coleção de avaliação (HSE), não do formulário
        expect($company->evaluationCollection()->hazards()->count())->toBeGreaterThan(0)
            ->and($company->psychosocialCollection()->hazards()->count())->toBe(0);
    });

    it('só permite trocar o formulário enquanto a conta não tem campanhas', function () {
        $company = Company::factory()->create([
            'psychosocial_collection_type' => MetodologyType::HSE->value,
        ]);

        expect($company->canSwitchPsychosocialQuestionnaire())->toBeTrue();

        Campaign::insert([
            'company_id' => $company->id,
            'collection_id' => BaseCollection::firstWhere('key', 'hse')->id,
            'type' => 'base',
            'name' => 'Campanha de teste do formulário',
            'start_date' => now(),
            'end_date' => now()->addWeek(),
            'status' => 'scheduled',
        ]);

        expect($company->fresh()->canSwitchPsychosocialQuestionnaire())->toBeFalse();
    });
});

describe('equivalência de polaridade Sebratel × HSE', function () {
    it('produz o mesmo valor armazenado para respostas semanticamente iguais', function () {
        // HSE (negativo, inverted=true): "Tenho prazos impossíveis de serem cumpridos?"
        // Sebratel (positivo, inverted=false): "Os prazos estabelecidos são adequados..."
        //
        // Pior cenário: prazos sempre impossíveis  ==  prazos nunca adequados
        expect(storedAnswerValue(HSEOption::ALWAYS, inverted: true))
            ->toBe(storedAnswerValue(HSEOption::NEVER, inverted: false));

        // Melhor cenário: prazos nunca impossíveis  ==  prazos sempre adequados
        expect(storedAnswerValue(HSEOption::NEVER, inverted: true))
            ->toBe(storedAnswerValue(HSEOption::ALWAYS, inverted: false));

        // A escala inteira coincide ponto a ponto
        $hseNegative = [HSEOption::NEVER, HSEOption::RARELY, HSEOption::SOMETIMES, HSEOption::FREQUENTLY, HSEOption::ALWAYS];
        $sebratelPositive = array_reverse($hseNegative);

        foreach ($hseNegative as $i => $hseOption) {
            expect(storedAnswerValue($hseOption, inverted: true))
                ->toBe(storedAnswerValue($sebratelPositive[$i], inverted: false));
        }
    });

    it('leva à mesma probabilidade de risco no motor HSE', function () {
        // Cinco respondentes. Cada um responde a questão negativa do HSE
        // (inverted=true) e a afirmação oposta do Sebratel (inverted=false) — que
        // é a opção espelhada na escala.
        $hseChoices = [HSEOption::ALWAYS, HSEOption::FREQUENTLY, HSEOption::SOMETIMES, HSEOption::RARELY, HSEOption::NEVER];
        $sebratelChoices = array_reverse($hseChoices);

        $hseMean = collect($hseChoices)->avg(fn ($o) => storedAnswerValue($o, inverted: true));
        $sebratelMean = collect($sebratelChoices)->avg(fn ($o) => storedAnswerValue($o, inverted: false));

        expect($sebratelMean)->toBe($hseMean)
            ->and(HSERiskService::scoreToProbability($sebratelMean, inverted: true))
            ->toBe(HSERiskService::scoreToProbability($hseMean, inverted: true));

        // Sanidade: média alta (bom) -> probabilidade baixa; média baixa (ruim) -> alta
        expect(HSERiskService::scoreToProbability(4.0, inverted: true))
            ->toBeLessThan(HSERiskService::scoreToProbability(0.0, inverted: true));
    });
});
