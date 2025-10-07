<?php

namespace App\Models;

use App\Enums\BaseCollectionType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BaseCollection extends Model
{
    protected $table = 'base_collections';
    public $timestamps = false;

    protected $casts = [
        'type' => BaseCollectionType::class,
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(BaseQuestion::class);
    }

    public function risks(): HasMany
    {
        return $this->hasMany(Hazard::class);
    }
}
