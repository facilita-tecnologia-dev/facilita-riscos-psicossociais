<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserCollection extends Model
{
    use HasFactory;

    protected $table = 'user_collections';

    public function answers(): HasMany
    {
        return $this->hasMany(UserAnswer::class);
    }
}
