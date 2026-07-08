<?php

namespace App\Livewire\Auth\Login;

use App\Models\Company;
use App\Rules\ValidateCNPJ;
use App\Services\Auth\AuthenticationService;
use Livewire\Component;

class CompanyLoginComponent extends Component
{
    public ?string $cnpj = null; 
    public ?string $password = null; 

    public function render()
    {
        return view('livewire.auth.login.company-login-component');
    }

    public function submit()
    {
        $credentials = $this->validate([
            'cnpj' => ['required', new ValidateCNPJ, 'max:100'],
            'password' => ['required', 'string', 'max:100'],
        ]);

        try {
            $company = Company::firstWhere('cnpj', $credentials['cnpj']);

            if($company) {
                if($redirectRoute = AuthenticationService::attempt('company', $credentials)){
                    return redirect()->intended($redirectRoute);
                }
            } else{
                $this->dispatch('alert:danger', 'Esta empresa não está cadastrada no sistema');
                return;
            }

            $this->dispatch('alert:danger', 'Credenciais incorretas');
        } catch (\Throwable $th) {
            report($th);
            $this->dispatch('alert:danger', 'Não foi posível fazer login');
        }
    }
}
