<?php

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('company/check', function (Request $request) {
    $data = $request->validate([
        'cnpj' => ['required', 'cnpj'],
    ]);

    $company = Company::where('cnpj', $data['cnpj'])->exists();
    
    return response()->json($company);
});

Route::post('/data/company/department', function (Request $request){
    $data = $request->validate([
        'cnpj' => ['required', 'cnpj'],
    ]);

    $company = Company::where('cnpj', $data['cnpj'])->first();

    if(!$company){
        return response()->json([
            'message' => 'Não foi possível encontrar a empresa.',
        ], 404);
    }

    $departments = $company->users()
    ->select('department')
    ->distinct()
    ->pluck('department');

    return $departments;
}); 
