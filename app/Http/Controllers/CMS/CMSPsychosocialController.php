<?php

namespace App\Http\Controllers\CMS;

use App\Models\Company;
use Illuminate\Http\Request;

class CMSPsychosocialController
{
    public function dashboard()
    {
        return view('cms.private.psychosocial.dashboard.index');
    }

    public function companyIndex()
    {
        return view('cms.private.psychosocial.company.index.index');
    }

    public function companyShow(Company $company)
    {
        return view('cms.private.psychosocial.company.show.index', compact('company'));
    }

    public function companyCreate()
    {
        return view('cms.private.psychosocial.company.create.index');
    }

    public function userIndex(Company $company)
    {
        return view('cms.private.psychosocial.user.index.index', compact('company'));
    }
    
    public function userCreate(Company $company)
    {
        return view('cms.private.psychosocial.user.create.index', compact('company'));
    }
    
    public function userImport(Company $company)
    {
        return view('cms.private.psychosocial.user.import.index', compact('company'));
    }
}
