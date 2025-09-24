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
}
