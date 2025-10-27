<?php

namespace App\Livewire\CMS\Auth;

use Livewire\Component;

class CMSLoginComponent extends Component
{
    public $email = ''; 
    public $password = ''; 

    public function render()
    {
        return view('livewire.cms.auth.cms-login-component');
    }

       public function submit()
    {
        $credentials = $this->validate([
            'email' => ['required', 'email', 'max:100'],
            'password' => ['required', 'string', 'max:100'],
        ]);
        
        // $company = Company::firstWhere('cnpj', $credentials['cnpj']);

        // if($company){
        //     $isInvalidSubscription = $company->subscription_type === CompanySubscriptionTypes::FREE_TRIAL_EXPIRED;
            
        //     if($isInvalidSubscription){
        //         session()->flash('login:free-trial-expired', true);
        //         return;
        //     }

        //     if($redirectRoute = AuthenticationService::authenticate('company', $credentials)){
        //         return redirect()->intended($redirectRoute);
        //     }
        // } else{
        //     session()->flash('login:incorrect', 'Este CNPJ não está cadastrado no sistema');
        // }
        
        // session()->flash('login:incorrect', 'Credenciais incorretas');

        // return back();
    }
}
