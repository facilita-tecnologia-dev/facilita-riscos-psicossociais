<?php

namespace App\Enums\ReportChannel;

use App\Enums\Traits\EnumHelpers;

enum ReportChannelUserTypes: string
{
    use EnumHelpers;

    case CONSULTANT = 'consultant';
    case LEGAL = 'legal';
    case EMPLOYEE = 'employee';

    public function label(): string
    {
        return match($this) {
            self::CONSULTANT => 'Consultor',
            self::LEGAL => 'Jurídico',
            self::EMPLOYEE => 'Colaborador da empresa',
        };
    }
}
