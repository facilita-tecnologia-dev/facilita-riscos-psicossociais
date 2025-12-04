<?php

namespace App\Http\Controllers\Private\User;

use App\Models\User;

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
        return view('private.user.index.index');
    }

    public function create()
    {
        return view('private.user.create.index');
    }
    
    public function import()
    {
        return view('private.user.import.index');
    }

    public function show(User $user)
    {
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

    // public function forgotPassword()
    // {
    //     return view('auth.forgot-password.user.index');
    // }

    // public function resetPassword(Request $request, string $token)
    // {
    //     return view('auth.reset-password.user.index', [
    //         'token' => $token,
    //         'email' => request('email')
    //     ]);
    // }

    // public function resetPasswordModal(Request $request, User $user)
    // {   
    //     $credentials = $request->validate([
    //         "current_password" => ['required'],
    //         'new_password' => ['required', 'confirmed', Password::defaults()],
    //     ]);
        
    //     if(AuthenticationService::resetPassword('user', $user, $credentials)){  
    //         return back()->with('message', 'Senha redefinida com sucesso!');
    //     };

    //     return back()->with('message', 'Não foi possível redefinir sua senha.');
    // }
}
