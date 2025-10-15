<?php

namespace App\Enums\HSE;

enum HSEEvaluationType: string
{
    case DEFAULT = 'default';
    case DEPARTMENT = 'department';
    case OCCUPATION = 'occupation';
}
