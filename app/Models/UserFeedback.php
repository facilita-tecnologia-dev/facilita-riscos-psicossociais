<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserFeedback extends Model
{
    /** @use HasFactory<\Database\Factories\UserFeedbackFactory> */
    use HasFactory;

    protected $table = 'user_feedbacks';
    public $timestamps = false;
}
