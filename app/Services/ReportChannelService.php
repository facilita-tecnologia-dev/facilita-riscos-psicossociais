<?php

namespace App\Services;

use App\Enums\RiskTypes;
use App\Models\Company;
use Illuminate\Support\Facades\Http;

class ReportChannelService
{
    public static function reports(Company $company)
    {
        $response = Http::post('https://canaldenuncias.facilitatecnologia.com.br/api/company/reports', [
            'cnpj' => $company->cnpj,
        ]); 

        $data = collect($response->json())
            ->filter(fn($_, $nature) => RiskTypes::tryFrom($nature))
            ->mapWithKeys(fn($count, $risk) => [$risk => round(($count / session('auth:company')->users->count()) * 100)]);
            
        return $data;
    }

    public static function hasReportChannel(Company $company)
    {
        $response = Http::post('https://canaldenuncias.facilitatecnologia.com.br/api/company/check', [
            'cnpj' => $company->cnpj,
        ]); 

        return $response->json();
    }
}
