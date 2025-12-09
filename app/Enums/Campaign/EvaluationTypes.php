<?php

namespace App\Enums\Campaign;

enum EvaluationTypes: string
{
    case DEPARTMENT = 'department';
    case OCCUPATION = 'occupation';

    public function label(): string
    {
        return match ($this) {
            self::DEPARTMENT => 'Setor',
            self::OCCUPATION => 'Função',
        };
    }
}