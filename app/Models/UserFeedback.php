<?php

namespace App\Models;

use App\Policies\UserFeedbackPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;

#[UsePolicy(UserFeedbackPolicy::class)]
class UserFeedback extends Model
{
    /** @use HasFactory<\Database\Factories\UserFeedbackFactory> */
    use HasFactory;

    protected $table = 'user_feedbacks';

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
