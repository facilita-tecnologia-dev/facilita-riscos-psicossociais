<?php

namespace App\Enums;

enum CollectionTypes: string
{
    case BASE = 'base';
    case CUSTOM = 'custom';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}