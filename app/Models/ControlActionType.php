<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ControlActionType extends Model
{
    protected $table = 'base_control_action_types';
    public $timestamps = false;
}
