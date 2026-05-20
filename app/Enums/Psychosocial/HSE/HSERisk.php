<?php

namespace App\Enums\Psychosocial\HSE;

enum HSERisk: string
{
    case TRIVIAL = '1';
    case TOLERABLE = '2';
    case MODERATE = '3';
    case SUBSTANTIAL = '4';
    case INTOLERABLE = '5';

    public function label(): string
    {
        return match ($this) {
            self::TRIVIAL => 'Trivial',
            self::TOLERABLE => 'Tolerável',
            self::MODERATE => 'Moderado',
            self::SUBSTANTIAL => 'Substancial',
            self::INTOLERABLE => 'Intolerável',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::INTOLERABLE => '#F44336',
            self::SUBSTANTIAL => '#FF9800',
            self::MODERATE => '#FFC107',
            self::TOLERABLE => '#CDDC39',
            self::TRIVIAL => '#4CAF50',
        };
    }

    public function message(): string
    {
        return match ($this) {
            self::INTOLERABLE => 'representa um nível elevado de impacto aos colaboradores, indicando uma situação crítica que requer atenção imediata e atuação prioritária.',
            self::SUBSTANTIAL => 'apresenta potencial significativo de impacto aos colaboradores, exigindo ações corretivas prioritárias e acompanhamento contínuo.',
            self::MODERATE => 'apresenta condições que merecem atenção e acompanhamento, sem indicar situação crítica no momento.',
            self::TOLERABLE => 'não apresenta perigo imediato aos colaboradores no momento, podendo ser acompanhado por medidas preventivas básicas.',
            self::TRIVIAL => 'não apresenta impacto relevante aos colaboradores, mantendo-se dentro de condições consideradas seguras e controladas.',
        };
    }
}
