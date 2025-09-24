<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public function scopeWithUserDepartmentAVG(Builder $query, Campaign $campaign, string $department)
    {
        $query->withAvg([
            'answers as average' => fn ($query) => $query->where('campaign_id', $campaign->id)
                                                        ->whereHas('user', fn($user) => $user->where('department', $department))
        ], 'value');
    }
}
