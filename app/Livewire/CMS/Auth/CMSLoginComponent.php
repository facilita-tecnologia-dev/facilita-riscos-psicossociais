<?php

namespace App\Livewire\CMS\Auth;

use App\Models\CMSUser;
use App\Services\Auth\AuthenticationService;
use Livewire\Component;

class CMSLoginComponent extends Component
{
    public ?string $user = null; 
    public ?string $password = null; 

    public function render()
    {
        return view('livewire.cms.auth.cms-login-component');
    }

       public function submit()
    {
        $credentials = $this->validate([
            'user' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string', 'max:100'],
        ]);
        
        $CMSUser = CMSUser::firstWhere('user', $credentials['user']);

        if($CMSUser){
            // $isInvalidSubscription = $company->subscription_type === CompanySubscriptionTypes::FREE_TRIAL_EXPIRED;
            
            // if($isInvalidSubscription){
            //     session()->flash('login:free-trial-expired', true);
            //     return;
            // }

            if($redirectRoute = AuthenticationService::attempt('cms', $credentials)){
                return redirect()->intended($redirectRoute);
            }
        } else{
            session()->flash('login:incorrect', 'Este CNPJ não está cadastrado no sistema');
        }
        
        // session()->flash('login:incorrect', 'Credenciais incorretas');

        // return back();
    }
}
