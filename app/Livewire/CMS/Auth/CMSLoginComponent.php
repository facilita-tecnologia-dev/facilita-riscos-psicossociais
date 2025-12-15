<?php

namespace App\Livewire\Cms\Auth;

use App\Models\CmsUser;
use App\Services\Auth\AuthenticationService;
use Livewire\Component;

class CmsLoginComponent extends Component
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
        
        $CmsUser = CmsUser::firstWhere('user', $credentials['user']);

        if($CmsUser){
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
