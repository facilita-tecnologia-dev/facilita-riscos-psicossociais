<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyOrganizationalIndicator extends Model
{
    protected $table = 'company_organizational_indicator';
    public $timestamps = false;

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function indicator(): BelongsTo
    {
        return $this->belongsTo(Organizationalndicator::class, 'indicator_id');
    }
}
