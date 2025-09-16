<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAnswer extends Model
{
    use HasFactory;

    protected $table = 'user_answers';

    protected $fillable = ['user_test_id', 'question_id'];

    /**
     * Returns the parent user test of this answer.
     */
    public function parentTest(): BelongsTo
    {
        return $this->belongsTo(UserTest::class, 'user_test_id');
    }

    /**
     * Returns the parent question this answer.
     */
    public function parentQuestion(): BelongsTo
    {
        return $this->belongsTo(CustomQuestion::class, 'question_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
