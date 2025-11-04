<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;

class CMSReportChannelController
{
    public function dashboard()
    {
        return view('cms.private.report-channel.dashboard.index');
    }

    public function companyIndex()
    {
        return view('cms.private.report-channel.company.index.index');
    }

    public function companyCreate()
    {
        return view('cms.private.report-channel.company.create.index');
    }

}
