<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ControlAction extends Model
{
    protected $table = 'base_control_actions';
    public $timestamps = false;
}
