<?php

namespace App\Models;

use App\Enums\BaseCollectionType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CustomCollection extends Model
{
    protected $table = 'custom_collections';
    public $timestamps = false;

    protected $casts = [
        'type' => BaseCollectionType::class,
    ];
}
