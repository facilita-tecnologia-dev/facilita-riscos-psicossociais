<?php

namespace App\Enums\Filters;

enum CompanyOrder: string
{
    case NAME_ASC  = 'name_asc';      // Nome A-Z
    case NAME_DESC = 'name_desc';     // Nome Z-A
    case CNPJ_ASC  = 'cnpj_asc';      // CNPJ Crescente
    case CNPJ_DESC = 'cnpj_desc';     // CNPJ Decrescente
    case USERS_DESC = 'users_desc';   // Mais funcionários
    case USERS_ASC = 'users_asc';     // Menos funcionários

    public function label(): string
    {
        return match ($this) {
            self::NAME_ASC => 'Razão Social (Ascendente)',
            self::NAME_DESC => 'Razão Social (Descendente)',
            self::CNPJ_ASC =>  'CNPJ (Ascendente)',
            self::CNPJ_DESC => 'CNPJ (Descendente)',
            self::USERS_ASC => 'Usuários Ativos (Ascendente)',
            self::USERS_DESC => 'Usuários Ativos (Descendente)',
        };
    }

    public function config(): array
    {
        return match ($this) {
            self::NAME_ASC => ['name', 'asc'],
            self::NAME_DESC => ['name', 'desc'],
            self::CNPJ_ASC =>  ['cnpj', 'asc'],
            self::CNPJ_DESC => ['cnpj', 'desc'],
            self::USERS_ASC => ['users_count', 'asc'],
            self::USERS_DESC => ['users_count', 'desc'],
        };
    }
}
