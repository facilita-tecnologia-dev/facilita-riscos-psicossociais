<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BaseQuestionTranslation extends Model
{
    protected $table = 'base_question_translations';
    public $timestamps = false;

    public function question(): BelongsTo
    {
        return $this->belongsTo(BaseQuestion::class);
    }
}
