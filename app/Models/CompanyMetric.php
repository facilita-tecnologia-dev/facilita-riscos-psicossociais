<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyMetric extends Model
{
    protected $table = 'company_metric';
    public $timestamps = false;

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function metric(): BelongsTo
    {
        return $this->belongsTo(Metric::class, 'metric_id');
    }
}
