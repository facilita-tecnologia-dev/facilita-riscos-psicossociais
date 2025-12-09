<?php

namespace App\Services\ReportChannel;

use App\Enums\Psychosocial\PROART\PROARTHazard;
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
            ->filter(fn($_, $nature) => PROARTHazard::tryFrom($nature))
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

    public static function allReports()
    {
        $response = Http::get('http://facilita-canal-de-denuncias.test/api/data/report/all'); 
        return $response->json();
    }

    public static function companies(?array $filters = null)
    {
        $response = Http::get('http://facilita-canal-de-denuncias.test/api/data/company', $filters); 
        return $response->json();
    }

    public static function company(string $companyID)
    {
        $response = Http::get("http://facilita-canal-de-denuncias.test/api/data/company/" . $companyID); 
        return $response->json();
    }

    public static function companyCreate(array $formData)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post('http://facilita-canal-de-denuncias.test/api/data/company/create', $formData); 

        return $response;
    }

    public static function companyUpdate(string $companyID, array $formData)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->put("http://facilita-canal-de-denuncias.test/api/data/company/" . $companyID . '/update', $formData); 

        return $response;
    }

    public static function companyAccessConfig(string $companyID, array $formData)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->put("http://facilita-canal-de-denuncias.test/api/data/company/" . $companyID . '/access', $formData); 

        return $response;
    }

    public static function companyCommittee(string $companyID)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->get("http://facilita-canal-de-denuncias.test/api/data/company/" . $companyID . '/committee'); 

        return $response->json();
    }

    public static function companyCommitteeAttach(string $companyID, string $userID, array $formData)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->put("http://facilita-canal-de-denuncias.test/api/data/company/" . $companyID .  "/committee/" . $userID . "/attach", $formData); 

        return $response;
    }

    public static function companyCommitteeDetach(string $companyID, string $userID)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->put("http://facilita-canal-de-denuncias.test/api/data/company/" . $companyID .  "/committee/" . $userID . "/detach"); 

        return $response;
    }

    public static function companyDepartments(string $companyID)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->get("http://facilita-canal-de-denuncias.test/api/data/company/" . $companyID . '/department'); 

        return $response->json();
    }

    public static function companyDepartmentCreate(string $companyID, array $formData)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post("http://facilita-canal-de-denuncias.test/api/data/company/" . $companyID . '/department/create', $formData); 

        return $response;
    }

    public static function companyDepartmentSoftDelete(string $companyID, string $departmentID)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->delete("http://facilita-canal-de-denuncias.test/api/data/company/" . $companyID . '/department/' . $departmentID . '/soft-delete'); 

        return $response;
    }

    public static function companyDepartmentForceDelete(string $companyID, string $departmentID)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->delete("http://facilita-canal-de-denuncias.test/api/data/company/" . $companyID . '/department/' . $departmentID . '/force-delete'); 

        return $response;
    }

    public static function companyDepartmentRestore(string $companyID, string $departmentID)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->put("http://facilita-canal-de-denuncias.test/api/data/company/" . $companyID . '/department/' . $departmentID . '/restore'); 

        return $response;
    }

    public static function users(array $filters)
    {
        $response = Http::get('http://facilita-canal-de-denuncias.test/api/data/user', $filters); 
        return $response->json();
    }

    public static function user(string $userID)
    {
        $response = Http::get("http://facilita-canal-de-denuncias.test/api/data/user/" . $userID); 
        return $response->json();
    }

    public static function userCreate(array $formData)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post('http://facilita-canal-de-denuncias.test/api/data/user/create', $formData); 

        return $response;
    }
    
    public static function userUpdate(string $userID, array $formData)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->put("http://facilita-canal-de-denuncias.test/api/data/user/" . $userID . '/update', $formData); 

        return $response;
    }
    
    // public static function userCompanies(string $userID, array $formData)
    // {
    //     $response = Http::withHeaders([
    //         'Accept' => 'application/json',
    //     ])->put("http://facilita-canal-de-denuncias.test/api/data/user/" . $userID . '/companies', $formData); 

    //     return $response;
    // }

    public static function userCompanies(string $userID)
    {
        $response = Http::get("http://facilita-canal-de-denuncias.test/api/data/user/" . $userID . "/companies"); 
        return $response->json();
    }
}
