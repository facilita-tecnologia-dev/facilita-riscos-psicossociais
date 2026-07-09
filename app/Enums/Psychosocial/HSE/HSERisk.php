<?php

namespace App\Enums\Psychosocial\HSE;

enum HSERisk: string
{
    case TRIVIAL = '1';
    case TOLERABLE = '2';
    case MODERATE = '3';
    case SUBSTANTIAL = '4';
    case INTOLERABLE = '5';

    public function default(): string
    {
        return match ($this) {
            self::TRIVIAL => 'Trivial',
            self::TOLERABLE => 'Tolerável',
            self::MODERATE => 'Moderado',
            self::SUBSTANTIAL => 'Substancial',
            self::INTOLERABLE => 'Intolerável',
        };
    }

    public function aiha(): string
    {
        return match ($this) {
            self::TRIVIAL => 'Trivial',
            self::TOLERABLE => 'Baixo',
            self::MODERATE => 'Moderado',
            self::SUBSTANTIAL => 'Alto',
            self::INTOLERABLE => 'Muito Alto',
        };
    }

    public function defaultColor(): string
    {
        return match ($this) {
            self::INTOLERABLE => '#F44336',
            self::SUBSTANTIAL => '#FF9800',
            self::MODERATE => '#FFC107',
            self::TOLERABLE => '#CDDC39',
            self::TRIVIAL => '#4CAF50',
        };
    }

    public function aihaColor(): string
    {
        return match ($this) {
            self::INTOLERABLE => '#100F0F',
            self::SUBSTANTIAL => '#F20D0D',
            self::MODERATE => '#F5A029',
            self::TOLERABLE => '#F4ED1F',
            self::TRIVIAL => '#48ED0C',
        };
    }

    public function defaultMessage(): string
    {
        return match ($this) {
            self::INTOLERABLE => 'representa um nível elevado de impacto aos colaboradores, indicando uma situação crítica que requer atenção imediata e atuação prioritária.',
            self::SUBSTANTIAL => 'apresenta potencial significativo de impacto aos colaboradores, exigindo ações corretivas prioritárias e acompanhamento contínuo.',
            self::MODERATE => 'apresenta condições que merecem atenção e acompanhamento, sem indicar situação crítica no momento.',
            self::TOLERABLE => 'não apresenta perigo imediato aos colaboradores no momento, podendo ser acompanhado por medidas preventivas básicas.',
            self::TRIVIAL => 'não apresenta impacto relevante aos colaboradores, mantendo-se dentro de condições consideradas seguras e controladas.',
        };
    }

    public function aihaMessage(): string
    {
        return match ($this) {
            self::INTOLERABLE =>'prioridade máxima. Adotar medidas imediatas de controle. Quando não, a continuidade da operação só poderá ocorrer com ciência e aprovação do gerente geral da unidade ou instalação. Iniciar processo de avaliação quantitativa do Setor / GHE para verificação do rebaixamento da categoria de risco.',
            self::SUBSTANTIAL => 'prioridade preferencial. Adotar medidas de controle para redução da exposição e iniciar processo de avaliação quantitativa do Setor / GHE.',
            self::MODERATE => 'prioridade básica. Iniciar processo de avalição quantitativa do Setor / GHE para confirmação da categoria e monitoramento periódico.',
            self::TOLERABLE => 'não prioritário. Ações dentro do princípio de melhoria contínua. Pode ser necessária avaliação quantitativa do Setor / GHE para confirmação da categoria, a critério profissional de Higiene Ocupacional.',
            self::TRIVIAL => 'não prioritário. Ações dentro do princípio de melhoria contínua. Pode ser necessária avaliação quantitativa do Setor / GHE para confirmação da categoria, a critério profissional de Higiene Ocupacional.',
        };
    }
}
