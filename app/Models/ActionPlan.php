<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ActionPlan extends Model
{
    protected $table = 'action_plans';
    public $timestamps = false;

    public function controlActions(): HasMany
    {
        return $this->hasMany(CustomControlAction::class);
    }

    protected $casts = [
        'file_date' => 'datetime',
    ];
}
