<?php

namespace App\Enums\Filters;

enum UsersCountRange: string
{
    case MICRO = '1-10';
    case SMALL = '11-20';
    case MEDIUM = '21-50';
    case LARGE = '51-100';
    case ENTERPRISE = '101-200';
    case CORPORATE = '200+';
}