<?php

namespace App\Enums\Filters;

enum ReportChannelUserOrder: string
{
    case NAME_ASC  = 'name_asc';      // Nome A-Z
    case NAME_DESC = 'name_desc';     // Nome Z-A
    case CPF_ASC  = 'CPF_asc';      // CPF Crescente
    case CPF_DESC = 'CPF_desc';     // CPF Decrescente
    case TYPE_DESC = 'type_desc';   // Mais funcionários
    case TYPE_ASC = 'type_asc';     // Menos funcionários

    public function label(): string
    {
        return match ($this) {
            self::NAME_ASC => 'Nome (Ascendente)',
            self::NAME_DESC => 'Nome (Descendente)',
            self::CPF_ASC =>  'CPF (Ascendente)',
            self::CPF_DESC => 'CPF (Descendente)',
            self::TYPE_ASC => 'Tipo (Ascendente)',
            self::TYPE_DESC => 'Tipo (Descendente)',
        };
    }

    public function config(): array
    {
        return match ($this) {
            self::NAME_ASC => ['full_name', 'asc'],
            self::NAME_DESC => ['full_name', 'desc'],
            self::CPF_ASC =>  ['cpf', 'asc'],
            self::CPF_DESC => ['cpf', 'desc'],
            self::TYPE_DESC => ['type', 'asc'],
            self::TYPE_ASC => ['type', 'desc'],
        };
    }
}
