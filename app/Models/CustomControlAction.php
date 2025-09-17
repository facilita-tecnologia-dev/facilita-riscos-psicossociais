<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomControlAction extends Model
{
    protected $table = 'custom_control_actions';
    public $timestamps = false;
}
