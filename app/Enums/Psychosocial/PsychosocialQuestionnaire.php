<?php

namespace App\Enums\Psychosocial;

use App\Enums\Campaign\MetodologyType;
use App\Enums\Traits\EnumHelpers;

/**
 * Define qual formulário de riscos psicossociais a empresa responde.
 *
 * É independente de `psychosocial_collection_type` (que define o motor de
 * avaliação: HSE ou PROART) e de `risk_matrix` (default/AIHA). O algoritmo de
 * identificação de risco não muda com esta configuração — apenas o conjunto de
 * perguntas apresentado ao funcionário.
 */
enum PsychosocialQuestionnaire: string
{
    use EnumHelpers;

    /** Usa o formulário padrão da metodologia da empresa (HSE ou PROART). */
    case STANDARD = 'standard';

    /** Formulário Sebratel — redação própria, avaliado pelo motor HSE. */
    case SB_BASED_ON_HSE = 'sb-based-on-hse';

    public function label(): string
    {
        return match ($this) {
            self::STANDARD => 'Padrão',
            self::SB_BASED_ON_HSE => 'Sebratel (baseado no HSE)',
        };
    }

    /**
     * Chave da BaseCollection a ser usada como fonte do questionário.
     * Para STANDARD, cai no tipo de metodologia da empresa.
     */
    public function collectionKey(string $methodologyCollectionType): string
    {
        return match ($this) {
            self::STANDARD => $methodologyCollectionType,
            self::SB_BASED_ON_HSE => MetodologyType::SB_BASED_ON_HSE->value,
        };
    }
}
