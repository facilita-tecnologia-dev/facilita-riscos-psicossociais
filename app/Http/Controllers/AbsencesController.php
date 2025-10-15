<?php

namespace App\Http\Controllers;

use App\Models\CompanyAbsence;
use Illuminate\Http\Request;

class AbsencesController
{
    public function index()
    {
        if(!session('auth:company')->usesHSE()) return back();
        return view('private.absences.index');
    }
}
