<?php

namespace App\Enums\Filters;

enum ReportChannelCompanyOrder: string
{
    case REGISTER_NAME_ASC  = 'register_name_asc';      // Nome A-Z
    case REGISTER_NAME_DESC = 'register_name_desc';     // Nome Z-A
    case CNPJ_ASC  = 'cnpj_asc';      // CNPJ Crescente
    case CNPJ_DESC = 'cnpj_desc';     // CNPJ Decrescente

    public function label(): string
    {
        return match ($this) {
            self::REGISTER_NAME_ASC => 'Razão Social (Ascendente)',
            self::REGISTER_NAME_DESC => 'Razão Social (Descendente)',
            self::CNPJ_ASC =>  'CNPJ (Ascendente)',
            self::CNPJ_DESC => 'CNPJ (Descendente)',
        };
    }

    public function config(): array
    {
        return match ($this) {
            self::REGISTER_NAME_ASC => ['register_name', 'asc'],
            self::REGISTER_NAME_DESC => ['register_name', 'desc'],
            self::CNPJ_ASC =>  ['cnpj', 'asc'],
            self::CNPJ_DESC => ['cnpj', 'desc'],
        };
    }
}
