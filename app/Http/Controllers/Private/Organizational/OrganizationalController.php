<?php

namespace App\Http\Controllers\Private\Organizational;

class OrganizationalController
{
    public function dashboard()
    {
        return view('private.organizational.dashboard.index');
    }

    public function feedback()
    {
        return view('private.organizational.feedback.index.index');
    }
}
