<?php

namespace App\Enums\Subscription;

enum PaymentKind: string
{
    case INITIAL = 'initial';
    case RENEWAL = 'renewal';
    case PLAN_CHANGE = 'plan_change';
}