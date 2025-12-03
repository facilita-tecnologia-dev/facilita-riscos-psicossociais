<?php

namespace App\Enums\Psychosocial;

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