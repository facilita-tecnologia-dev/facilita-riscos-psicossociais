<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CachePsychosocialRating extends Model
{
    protected $table = 'cache_psychosocial_ratings';
    public $timestamps = false;

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
 
    public function risk(): BelongsTo
    {
        return $this->belongsTo(Risk::class);
    }
 
    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }
}
