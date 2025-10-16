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

    protected BaseCollection | CustomCollection $collection;

    protected $casts = [
        'type' => CollectionType::class,
        'status' => CampaignStatus::class,
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];


    public function collection(): BaseCollection | CustomCollection
    {   
        if(!isset($this->collection)){
            if($this->type === CollectionType::CUSTOM){
                $this->collection = CustomCollection::find($this->collection_id);
            }
         
            $this->collection = BaseCollection::find($this->collection_id);
        }

        return $this->collection;
    }

    public function userCollections(): HasMany
    {
        return $this->hasMany(UserCollection::class);
    }

}
