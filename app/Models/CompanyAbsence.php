<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyAbsence extends Model
{
    use SoftDeletes;

    protected $table = 'company_absences';

    public function cid(): BelongsTo
    {
        return $this->belongsTo(CID::class, 'cid_id');
    }
}
