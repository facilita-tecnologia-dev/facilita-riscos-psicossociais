<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyPROARTIndicator extends Model
{
    protected $table = 'company_proart_indicator';
    public $timestamps = false;

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function metric(): BelongsTo
    {
        return $this->belongsTo(PROARTIndicator::class, 'indicator_id');
    }
}
