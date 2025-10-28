<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;

class CMSPsychosocialController
{
    public function dashboard()
    {
        return view('cms.private.psychosocial.dashboard.index');
    }
}
