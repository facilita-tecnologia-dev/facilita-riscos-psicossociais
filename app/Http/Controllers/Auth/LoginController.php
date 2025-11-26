<?php

namespace App\Http\Controllers\Auth;

use App\Enums\RoleEnum;
use App\Models\Company;
use App\Models\User;
use App\Services\AuthenticationService;
use Illuminate\Http\Request;

class LoginController
{
    public function authenticateUser(Request $request)
    {
        $credentials = $request->validate([
            'cpf' => ['required', 'string', 'cpf'],
        ]);

        if($redirectRoute = AuthenticationService::attempt('user', $credentials)){
            return redirect()->to($redirectRoute);
        };
  
        return back();
    }

    // public function authenticateCompany(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'cnpj' => ['required', 'string', new validateCNPJ],
    //         'password' => ['required'],
    //     ]);

    //     if($redirectRoute = AuthenticationService::attempt('company', $credentials)){
    //         return redirect()->to($redirectRoute);
    //     }

    //     return back();
    // }

    public function showChooseCompany(User $user)
    {
        return view('auth.login.user.choose-company', compact('user'));
    }

    public function chooseCompany(User $user, Company $company)
    {
        AuthenticationService::putCompanyOnSession($company);

        if(AuthenticationService::checkUserIsManager($user)) return redirect()->to(route('user.login.password', $user));

        AuthenticationService::authenticate('user', $user);

        return redirect()->to(AuthenticationService::redirectLoginRoute('user'));
    }

    public function showCheckPassword(User $user){
        return view('auth.login.user.password', compact('user'));
    }

    public function checkPassword(Request $request, User $user)
    {
        $credentials = $request->validate([
            'password' => ['required'],
        ]);

        if($user->is_temp_password){
            if(!AuthenticationService::checkTempPassword($credentials['password'], $user->password)) return back();
        } else{
            if(!AuthenticationService::checkPassword($credentials['password'], $user->password)) return back();
        }

        AuthenticationService::authenticate('user', $user);
        
        if($user->is_temp_password){
            return redirect()->to(route('user.reset-password', $user));
        }

        return redirect()->to(AuthenticationService::redirectLoginRoute('user'));
    }

    public function switchCompany(Request $request){
        $data = $request->validate([
            'company_id' => ['required'],
        ]);

        if($data['company_id'] === session('auth:company')->id) return back();
     
        $user = session('auth:user');   
        $company = Company::find($data['company_id']);

        $roleOnAuthCompany = $user->role(session('auth:company'));
        $roleInRequestCompany = $user->role($company);

        AuthenticationService::logout($request);
        
        AuthenticationService::putCompanyOnSession($company);
        AuthenticationService::putGuardOnSession('user');
        
        if($roleOnAuthCompany->type === RoleEnum::EMPLOYEE->value && $roleInRequestCompany->type === RoleEnum::MANAGER->value) return redirect()->to(route('user.login.password', $user));

        AuthenticationService::authenticate('user', $user);

        return redirect()->to(AuthenticationService::redirectLoginRoute('user'));
    }
}
