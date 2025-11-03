<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;

class CMSReportChannelController
{
    public function dashboard()
    {
        return view('cms.private.report-channel.dashboard.index');
    }
}
