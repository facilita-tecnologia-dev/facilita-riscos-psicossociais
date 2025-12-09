<?php

namespace App\Enums\Psychosocial;

enum UserOrder: string
{
    case NAME_ASC  = 'name_asc';      // Nome A-Z
    case NAME_DESC = 'name_desc';     // Nome Z-A
    case CPF_ASC  = 'CPF_asc';      // CPF Crescente
    case CPF_DESC = 'CPF_desc';     // CPF Decrescente
    case DEPARTMENT_DESC = 'department_desc';   // Mais funcionários
    case DEPARTMENT_ASC = 'department_asc';     // Menos funcionários

    public function label(): string
    {
        return match ($this) {
            self::NAME_ASC => 'Nome (Ascendente)',
            self::NAME_DESC => 'Nome (Descendente)',
            self::CPF_ASC =>  'CPF (Ascendente)',
            self::CPF_DESC => 'CPF (Descendente)',
            self::DEPARTMENT_ASC => 'Setor (Ascendente)',
            self::DEPARTMENT_DESC => 'Setor (Descendente)',
        };
    }

    public function config(): array
    {
        return match ($this) {
            self::NAME_ASC => ['name', 'asc'],
            self::NAME_DESC => ['name', 'desc'],
            self::CPF_ASC =>  ['cpf', 'asc'],
            self::CPF_DESC => ['cpf', 'desc'],
            self::DEPARTMENT_DESC => ['department', 'asc'],
            self::DEPARTMENT_ASC => ['department', 'desc'],
        };
    }
}
