<?php

namespace App\Services;

use App\Services\User\UserFilterService;
use Illuminate\Support\Collection;

class OrganizationalClimateService
{
    public function __construct(
        protected UserFilterService $filterService
    ) {}

    public function getOrganizationalData($request, $applyFilters = false): Collection
    {
        $query = session('auth:company')->users()
            ->whereHas('latestOrganizationalClimateCollection')
            ->withLatestOrganizationalClimateCollection(fn($q) => 
                $q->whereYear('created_at', $request->year ?? now()->year)
                  ->withCollectionTypeName('organizational-climate')
                  ->withTests(fn($q) => $q->withAnswers()->withTestType())
                //   ->withCustomTests(fn($q) => $q->withAnswers()->withCustomTestType())
            );

        $users = $query->getQuery();

        return $applyFilters 
            ? $this->filterByRequestFilters($users) 
            : $users->get();
    }

    public function filterByRequestFilters($query)
    {
        return $this->filterService->apply($query)->get();
    }

    public function filterByDepartmentScope(Collection $users): Collection
    {
        $user = session('auth:user');
        if (!session('auth:guard') === 'user') {
            return $users;
        }

        $allowedDepartments = $user->departmentScopes
            ->where('allowed', 1)
            ->pluck('department')
            ->toArray();
            

        return $users->filter(function ($u) use ($allowedDepartments) {
            return session('auth:guard') === 'user' && in_array($u->department, $allowedDepartments);
        });
    }
}
