<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BaseQuestion extends Model
{
    protected $table = 'base_questions';
    public $timestamps = false;

    public function answers(): HasMany
    {
         return $this->hasMany(UserAnswer::class, 'question_id');
    }
}
