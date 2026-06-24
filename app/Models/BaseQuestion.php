<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function translations(): HasMany
    {
        return $this->hasMany(BaseQuestionTranslation::class);
    }

    public function getStatementAttribute($value): string
    {
        if (! $this->relationLoaded('translations')) return $value;

        $translation = $this->translations->firstWhere('locale', app()->getLocale());
        return $translation?->statement ?? $value;
    }

    public function scopeWithUserDepartmentAVG(Builder $query, Campaign $campaign, string $department)
    {
        $query->withAvg([
            'answers as average' => fn ($query) => $query->where('campaign_id', $campaign->id)
                                                        ->whereHas('user', fn($user) => $user->where('department', $department))
        ], 'value');
    }
}
