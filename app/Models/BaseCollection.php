<?php

namespace App\Models;

use App\Enums\Campaign\CollectionType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BaseCollection extends Model
{
    protected $table = 'base_collections';
    public $timestamps = false;

    protected $casts = [
        'type' => CollectionType::class,
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(BaseQuestion::class);
    }

    public function hazards(): HasMany
    {
        return $this->hasMany(Hazard::class);
    }
}
