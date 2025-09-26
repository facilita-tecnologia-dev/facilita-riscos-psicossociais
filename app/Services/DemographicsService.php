<?php

namespace App\Services;

use Carbon\Carbon;

class DemographicsService
{
    public static function metrics()
    {
        $metrics = session('auth:company')->metrics()
                                        ->with('metric')
                                        ->get()
                                        ->mapWithKeys(fn($companyMetric) => 
                                            [$companyMetric->metric->display_name => $companyMetric->value ?? 0]
                                        );

        return $metrics;
    }

    public static function demographics()
    {
        $companyUsers = session('auth:company')->users()->get();
        
        $departments = $companyUsers
        ->filter(fn($user) => !is_null($user->department))
        ->groupBy('department')
            ->mapWithKeys(fn($users, $department) => 
                [$department => [
                    'count' => $users->count(), 
                    'percentage' => round(($users->count() / $companyUsers->filter(fn($user) => !is_null($user->department))->count()) * 100)
                ]]);

        $genders = $companyUsers
        ->filter(fn($user) => !is_null($user->gender))
        ->groupBy('gender')
            ->mapWithKeys(fn($users, $gender) => 
                [$gender => [
                    'count' => $users->count(), 
                    'percentage' => round(($users->count() / $companyUsers->filter(fn($user) => !is_null($user->gender))->count()) * 100)
                ]]);

        $admissions = $companyUsers
        ->filter(fn($user) => !is_null($user->admission))
        ->groupBy(function ($user) {
            $years = Carbon::parse($user->admission)->diffInYears(Carbon::now());
    
            return match (true) {
                $years <= 1 => '0-1 ano',
                $years <= 5 => '2-4 anos',
                $years <= 10 => '5-10 anos',
                default => 'Mais de 10 anos',
            };
        })
        ->mapWithKeys(fn($users, $period) => 
            [$period => [
                'count' => $users->count(), 
                'percentage' => round(($users->count() / $companyUsers->filter(fn($user) => !is_null($user->admission))->count()) * 100)
            ]]);

        $ages = $companyUsers
        ->filter(fn($user) => !is_null($user->birth_date))
        ->groupBy(function ($user) {
            $age = Carbon::parse($user->birth_date)->age;

            return match (true) {
                $age <= 25 => '18-25 anos',
                $age <= 35 => '26-35 anos',
                $age <= 45 => '36-45 anos',
                default => 'Mais de 45 anos'
            };
        })->mapWithKeys(fn($users, $range) => 
            [$range => [
                'count' => $users->count(), 
                'percentage' => round(($users->count() / $companyUsers->filter(fn($user) => !is_null($user->birth_date))->count()) * 100)
            ]]);

        
        $demographics = [
            'Por departamento' => $departments,
            'Por sexo' => $genders,
            'Por período de admissão' => $admissions,
            'Por faixa etária' => $ages
        ];

        return $demographics;
    }
}
