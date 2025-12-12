<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationalReport extends Model
{
    protected $table = 'organizational_reports';
    public $timestamps = false;

    protected $casts = [
        'file_date' => 'datetime',
    ];
}
