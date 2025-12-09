<?php

namespace App\Enums\OC;

enum OCEvaluation: string
{
    case DEPARTMENT = 'department';
    case OCCUPATION = 'occupation';
    case GENDER = 'gender';
    case WORK_SHIFT = 'work_shift';
    case ADMISSION_RANGE = 'admission_range';

    public function label(): string
    {
        return match ($this) {
            self::DEPARTMENT => 'Setor',
            self::OCCUPATION => 'Função',
            self::GENDER => 'Sexo',
            self::WORK_SHIFT => 'Turno',
            self::ADMISSION_RANGE => 'Tempo de Admissão',
            self::ADMISSION_RANGE => 'Tempo de Admissão',
        };
    }
}