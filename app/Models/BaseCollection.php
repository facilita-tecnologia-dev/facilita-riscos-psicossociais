<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BaseCollection extends Model
{
    protected $table = 'base_collections';
    public $timestamps = false;

    public function questions(): HasMany
    {
        return $this->hasMany(BaseQuestion::class);
    }
}
