<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;

class CmsReportChannelController
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

    public function companyShow(string $companyID)
    {
        return view('cms.private.report-channel.company.show.index', compact('companyID'));
    }

    public function userIndex()
    {
        return view('cms.private.report-channel.user.index.index');
    }

    public function userCreate()
    {
        return view('cms.private.report-channel.user.create.index');
    }

    public function userShow(string $userID)
    {
        return view('cms.private.report-channel.user.show.index', compact('userID'));
    }
}
