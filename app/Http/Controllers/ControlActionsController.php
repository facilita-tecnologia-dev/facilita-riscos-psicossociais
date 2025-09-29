<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControlActionsController
{
    public function edit()
    {
        return view('private.control-action.edit');
    }
}
