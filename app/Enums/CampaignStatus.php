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

    public function icon(): string
    {
        return match ($this) {
            self::SCHEDULED => 'calendar-check',
            self::IN_PROGRESS => 'clock',
            self::COMPLETED => 'check',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::SCHEDULED => '#FFD60A',
            self::IN_PROGRESS => '#5EC8BC',
            self::COMPLETED => '#5EC8BC',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
