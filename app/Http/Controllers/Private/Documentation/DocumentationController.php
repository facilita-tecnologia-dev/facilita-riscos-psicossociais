<?php

namespace App\Http\Controllers\Private\Documentation;

use Illuminate\Http\Request;

class DocumentationController
{
    public function index()
    {
        return view('private.documentation.index.index');
    }

    public function policy()
    {
        return view('private.documentation.policy.index');
    }
}
