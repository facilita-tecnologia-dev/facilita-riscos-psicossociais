<?php

namespace App\Enums\HSE;

enum HSEGroup: string
{
    case DEMANDS = 'demands';
    case CONTROL = 'control';
    case SUPPORT = 'support';
    case RELATIONSHIPS = 'relationships';
    case ROLE = 'role';
    case CHANGE = 'change';

    public function label(): string
    {
        return match ($this) {
            self::DEMANDS => 'Demandas',
            self::CONTROL => 'Controle',
            self::SUPPORT => 'Suporte',
            self::RELATIONSHIPS => 'Relacionamentos',
            self::ROLE => 'Papel',
            self::CHANGE => 'Mudança',
            
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}