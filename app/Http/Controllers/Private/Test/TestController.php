<?php

namespace App\Http\Controllers\Private\Test;

use App\Models\Campaign;

class TestController
{
    public function show(Campaign $campaign)
    {        
        return view('private.test.index.index', compact('campaign'));
    }
}
