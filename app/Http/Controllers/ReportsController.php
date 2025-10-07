<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReportsController
{
    public function update(Request $request)
    {
        Gate::authorize('metrics-edit');

        $data = $request->validate([
            "moral-harassment" => 'nullable|between:0,100',
            "sexual-harassment" => 'nullable|between:0,100',
            "discrimination" => 'nullable|between:0,100',
            "other-forms-of-violence" => 'nullable|between:0,100',
        ]);

        collect($data)->each(function($value, $risk){
            $report = session('auth:company')->reports()->where('type', $risk)->first();
            if($report) $report->update(['value' => $value]);
        });
        
        return back()->with('message', 'Denúncias armazenados com sucesso!');
    }
}
