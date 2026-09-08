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
            self::STANDARD => 'HSE Original',
            self::SB_BASED_ON_HSE => 'Sebratel (baseado no HSE)',
        };
    }

    /** Nome curto da metodologia, para rótulos e legendas. */
    public function methodologyName(): string
    {
        return match ($this) {
            self::STANDARD => 'HSE-IT (Health and Safety Executive - Indicator Tool)',
            self::SB_BASED_ON_HSE => 'HSE Management Standards, adaptada ao GRO/NR-01',
        };
    }

    /**
     * Texto de metodologia para documentos e telas com contexto de empresa
     * (ex.: seção "Metodologia" do Inventário de Riscos). Fonte única da redação.
     */
    public function methodologyStatement(): string
    {
        $intro = match ($this) {
            self::STANDARD => 'A metodologia adotada para a avaliação dos riscos psicossociais é baseada no modelo HSE-IT (Health and Safety Executive - Indicator Tool), reconhecido internacionalmente para a análise de fatores psicossociais no ambiente de trabalho.',
            self::SB_BASED_ON_HSE => 'Metodologia de avaliação de fatores de riscos psicossociais baseada nos HSE Management Standards, adaptada ao contexto organizacional brasileiro e aos requisitos do GRO/NR-01.',
        };

        return $intro . ' Ela se fundamenta na organização e análise estruturada das respostas coletadas por meio de formulários padronizados, considerando grupos de perigos previamente definidos e fatores organizacionais como setor e função. Os dados são tratados de forma agregada, permitindo a avaliação de contextos organizacionais, e não de indivíduos. A partir dessa estrutura, um mecanismo técnico realiza a análise dos resultados conforme critérios específicos para cada tipo de perigo, podendo considerar informações complementares de saúde ocupacional quando disponíveis, assegurando coerência normativa, consistência técnica e maior precisão na identificação dos níveis de risco.';
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
