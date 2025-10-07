<?php

namespace App\Models;

use App\Enums\CampaignStatus;
use App\Enums\CollectionType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    protected $table = 'campaigns';
    public $timestamps = false;

    protected $casts = [
        'type' => CollectionType::class,
        'status' => CampaignStatus::class,
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];


    public function collection(): BaseCollection | CustomCollection
    {   
        if($this->type === CollectionType::CUSTOM){
            return CustomCollection::find($this->collection_id);
        }
     
        return BaseCollection::find($this->collection_id);
    }

    public function userCollections(): HasMany
    {
        return $this->hasMany(UserCollection::class);
    }

}
