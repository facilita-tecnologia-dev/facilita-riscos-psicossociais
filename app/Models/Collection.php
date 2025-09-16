<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Collection extends Model
{
    protected $table = 'collections';

    protected $fillable = ['name', 'description'];

    /**
     * Returns the tests related to this collection.
     */
    public function tests(): HasMany
    {
        return $this->hasMany(Test::class, 'collection_id');
    }

    public function customTests(): HasMany
    {
        return $this->hasMany(CustomTest::class);
    }
}
