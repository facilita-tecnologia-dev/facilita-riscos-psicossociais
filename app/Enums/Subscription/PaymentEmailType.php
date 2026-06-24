<?php

namespace App\Enums\Subscription;

enum PaymentEmailType: string
{
    case CREATED = 'created';
    case DUE_IN_3_DAYS = 'due_in_3_days';
    case DUE_IN_1_DAY = 'due_in_1_day';
    case DUE_TODAY = 'due_today';

    case OVERDUE_3_DAYS = 'overdue_3_days';
    case OVERDUE_7_DAYS = 'overdue_7_days';
    case OVERDUE_15_DAYS = 'overdue_15_days';
}