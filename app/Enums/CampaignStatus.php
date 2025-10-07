<?php

namespace App\Enums;

enum CampaignStatus: string
{
    case SCHEDULED = 'scheduled';
    case IN_PROGRESS = 'in-progress';
    case COMPLETED = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::SCHEDULED => 'Agendada',
            self::IN_PROGRESS => 'Em andamento',
            self::COMPLETED => 'Finalizada',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
