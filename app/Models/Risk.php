<?php

namespace App\Models;

use App\Services\User\UserFilterService;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Risk extends Model
{
    protected $table = 'risks';
    public $timestamps = false;

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(BaseQuestion::class, 'question_risk');
    }

    public function controlActions(): HasMany
    {
        return $this->hasMany(ControlAction::class);
    }

    public function getRouteKeyName()
    {
        return 'type';
    }
}
