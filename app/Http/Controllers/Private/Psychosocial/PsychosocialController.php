<?php

namespace App\Http\Controllers\Private\Psychosocial;

class PsychosocialController
{
    public function dashboard()
    {
        return view('private.psychosocial.dashboard.index');
    }

    public function indicators()
    {
        return view('private.psychosocial.indicator.index');
    }

    public function absences()
    {
        return view('private.psychosocial.absence.index');
    }

    public function controlActions()
    {
        return view('private.psychosocial.control-action.index');
    }
}
