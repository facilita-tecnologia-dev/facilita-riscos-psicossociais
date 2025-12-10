<?php

namespace App\Http\Controllers\Private\User;

use App\Models\User;
use App\Services\Auth\AuthenticationService;
use Illuminate\Support\Facades\Gate;

class UserController
{   
    public function home()
    {
        return view('private.home.user.index');
    }

    public function login()
    {
        return view('auth.login.user.index');
    }

    public function index()
    {
        Gate::forUser(AuthenticationService::user())->authorize('viewAny', [User::class]);
        return view('private.user.index.index');
    }

    public function create()
    {
        Gate::forUser(AuthenticationService::user())->authorize('create', [User::class]);
        return view('private.user.create.index');
    }
    
    public function import()
    {
        Gate::forUser(AuthenticationService::user())->authorize('create', [User::class]);
        return view('private.user.import.index');
    }

    public function show(User $user)
    {
        if($user->id === session('auth:user')->id){
            Gate::forUser(AuthenticationService::user())->authorize('view', [User::class, $user]);
        } else {
            Gate::forUser(AuthenticationService::user())->authorize('edit', [User::class, $user]);
        }

        return view('private.user.show.index', compact('user'));
    }

    // public function showDepartmentScope(User $user)
    // {
    //     Gate::authorize('user-department-scope-edit');

    //     $companyDepartments = Company::firstWhere('id', session('auth:company')->id)
    //         ->users()
    //         ->pluck('department')
    //         ->unique()
    //         ->values()
    //         ->sortBy(function ($department) use ($user) {
    //             return $department === $user->department ? 0 : 1;
    //         })
    //     ->values();

    //     $userDepartmentPermissions = UserDepartmentPermission::where('company_id', session('auth:company')->id)
    //         ->where('user_id', $user->id)
    //         ->orderBy('allowed', 'desc')
    //         ->orderByRaw("CASE WHEN department = ? THEN 0 ELSE 1 END", [$user->department])
    //     ->get();


    //     return view('private.user.department-scope', compact('user', 'companyDepartments', 'userDepartmentPermissions'));
    // }

    // public function updateDepartmentScopes(Request $request, User $user)
    // {
    //     Gate::authorize('user-department-scope-edit');

    //     $currentDepartmentScopes = UserDepartmentPermission::where('company_id', session('auth:company')->id)
    //         ->where('user_id', $user->id)
    //         ->get();

    //     $newDepartmentScopes = $request->except(['_token', '_method']);

    //     foreach($currentDepartmentScopes as $departmentScope){
    //         $newDepartmentRelated = $newDepartmentScopes[$departmentScope->department] ?? null;

    //         if($newDepartmentRelated){
    //             $departmentScope->allowed = 1;
    //             $departmentScope->save();
    //         } else{
    //             $departmentScope->allowed = 0;
    //             $departmentScope->save();
    //         }
    //     }

    //     foreach($newDepartmentScopes as $departmentName => $departmentScope){
    //         if(! $currentDepartmentScopes->firstWhere('department', $departmentName)){
    //             UserDepartmentPermission::create([
    //                 'company_id' => session('auth:company')->id,
    //                 'user_id' => $user->id,
    //                 'department' => $departmentName,
    //                 'allowed' => $departmentScope,
    //             ]);
    //         }
    //     }

    //     return to_route('user.permissions', $user)->with('message', 'Visão de Setores atualizada com sucesso!');
    // }
}
