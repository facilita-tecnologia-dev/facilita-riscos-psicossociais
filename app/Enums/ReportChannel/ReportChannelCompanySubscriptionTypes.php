<?php

namespace App\Enums\ReportChannel;

use App\Enums\Traits\EnumHelpers;

enum ReportChannelCompanySubscriptionTypes: string
{
    use EnumHelpers;

    case FREE_TRIAL = 'free-trial';
    case FREE_TRIAL_EXPIRED = 'free-trial-expired';
    case SUBSCRIBED = 'subscribed';

    public function label(): string
    {
        return match($this) {
            self::FREE_TRIAL => 'Teste gratuito',
            self::FREE_TRIAL_EXPIRED => 'Teste gratuito expirou',
            self::SUBSCRIBED => 'Assinante',
        };
    }
}
