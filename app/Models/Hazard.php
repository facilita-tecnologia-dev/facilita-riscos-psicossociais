<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hazard extends Model
{
    protected $table = 'hazards';
    public $timestamps = false;

    public function cids(): BelongsToMany
    {
        return $this->belongsToMany(CID::class, 'hazard_cid', 'hazard_id', 'cid_id');
    }

    public function collection(): BelongsTo
    {
        return $this->belongsTo(BaseCollection::class, 'base_collection_id');
    }

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(BaseQuestion::class, 'question_hazard');
    }

    public function controlActions(): HasMany
    {
        return $this->hasMany(BaseControlAction::class);
    }

    public function getRouteKeyName()
    {
        return 'type';
    }
}
