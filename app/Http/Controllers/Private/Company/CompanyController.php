<?php

namespace App\Http\Controllers\Private\Company;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController
{
    public function register()
    {
        return view('auth.register.company.index');
    }

    public function login()
    {
        return view('auth.login.company.index');
    }

    public function home()
    {
        return view('private.home.company.index');
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password.company.index');
    }

    public function resetPassword(Request $request, string $token)
    {
        return view('auth.reset-password.company.index', [
            'token' => $token,
            'email' => request('email')
        ]);
    }

    public function show(Company $company)
    {
        return view('private.company.show.index', compact('company'));
    }

    // public function show(string $id)
    // {
    //     Gate::authorize('company-show');
    //     $company = session('auth:company');

    //     return view('private.company.show', compact('company'));
    // }

    // public function edit(string $id)
    // {
    //     Gate::authorize('company-edit');
    //     $company = session('auth:company');

    //     return view('private.company.update', compact('company'));
    // }

    // public function update(Request $request)
    // {
    //     Gate::authorize('company-edit');
    //     $company = session('auth:company');

    //     $validatedData = $request->validate([
    //         'logo' => ['nullable'],
    //         'email' => ['required', 'email'],
    //     ]);

    //     if(isset($validatedData['logo'])){
    //         $path = $validatedData['logo']->store('images', 'public');
    //         $url = Storage::url($path);
            
    //         $company->logo = $url;
    //     }

    //     $company->email = $validatedData['email'];

    //     session(['company' => $company]);
    //     $company->save();

    //     return back()->with('message', 'Perfil da empresa atualizado com sucesso!');
    // }

    // public function destroy(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'password' => ['required']
    //     ]);

    //     if(!Hash::check($validatedData['password'], session('auth:company')->password)){
    //         SessionErrorHelper::flash('password', 'Senha incorreta.');
    //         return back();
    //     }

    //     session('auth:company')->delete();

    //     return redirect()->to(route('logout'));
    // }



    // public function resetPasswordModal(Request $request, Company $company)
    // {   
    //     $credentials = $request->validate([
    //         "current_password" => ['required'],
    //         'new_password' => ['required', 'confirmed', Password::defaults()],
    //     ]);
        
    //     if(AuthenticationService::resetPassword('company', $company, $credentials)){  
    //         return back()->with('message', 'Senha redefinida com sucesso!');
    //     };

    //     return back()->with('message', 'Não foi possível redefinir sua senha.');
    // }


}
