<?php

namespace App\Models;

use App\Services\User\UserFilterService;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Risk extends Model
{
    protected $table = 'risks';
    public $timestamps = false;

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(BaseQuestion::class, 'question_risk');
    }

    public function getRouteKeyName()
    {
        return 'type';
    }

    public function scopeWithQuestionAvg(Builder $query, Campaign $campaign)
    {
        $query->with([
            'questions' => function ($q) use ($campaign) {
                $q->withAvg([
                    'answers as average' => function ($query) use ($campaign) {
                        $query->where('campaign_id', $campaign->id)->whereHas('user', fn($user) => UserFilterService::apply($user));
                    }
                ], 'value');
            }
        ]);
    }
}
