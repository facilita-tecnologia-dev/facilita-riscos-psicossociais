<?php

namespace App\Models;

use App\Enums\CampaignStatusTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    protected $table = 'campaigns';
    public $timestamps = false;

    protected $casts = [
        'status' => CampaignStatusTypes::class,
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function collection(): BelongsTo
    {
        return $this->belongsTo(BaseCollection::class);
    }

    public function userCollections(): HasMany
    {
        return $this->hasMany(UserCollection::class);
    }

}
