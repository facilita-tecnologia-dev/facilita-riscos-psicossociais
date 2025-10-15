<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomControlAction extends Model
{
    protected $table = 'custom_control_actions';
    public $timestamps = false;

    public function actionPlan(): BelongsTo
    {
        return $this->belongsTo(ActionPlan::class);
    }

    public function hazard(): BelongsTo
    {
        return $this->belongsTo(Hazard::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(ControlActionType::class, 'control_action_type_id');
    }
}
