<?php

namespace App\Livewire\Private\User;

use App\Enums\User\UserRole;
use App\Models\Company;
use App\Services\Auth\AuthenticationService;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Throwable;

class SwitchCompanyComponent extends Component
{
    public ?string $company_id = null;
    public ?string $password = null;

    public bool $needsPassword = false;

    public array $companies = [];

    public function render()
    {
        return view('livewire.private.user.switch-company-component');
    }

    public function mount()
    {
        $companies = session('auth:user')->companies()->whereNot('companies.id', session('auth:company')->id)->get()->toArray();
        $this->companies = array_map(fn ($company) => ['label' => $company['name'], 'value' => $company['id']], $companies);
    }    
    
    public function updatedCompanyId($company_id)
    {
        $company = Company::find($company_id);
        
        $roleInCurrentCompany = session('auth:user')->role(session('auth:company'));
        $roleInSelectedCompany = session('auth:user')->role($company);

        if($roleInCurrentCompany->type === UserRole::MANAGER->value){
            $this->needsPassword = false;
            return;
        }
        
        if($roleInCurrentCompany->type === UserRole::EMPLOYEE->value && $roleInSelectedCompany->type === UserRole::EMPLOYEE->value){
            $this->needsPassword = false;
            return;
        }

        $this->needsPassword = true;
    }

    public function submit()
    {
        $this->validate([
            'company_id' => ['required', 'string', 'max:100'],
            'password'   => $this->needsPassword
                ? ['required', 'string', 'max:100']
                : ['nullable', 'string', 'max:100'],
        ]);
        
        try {        
            $company = Company::find($this->company_id);
            $user = session('auth:user');
            
            AuthenticationService::logout(request());
            
            AuthenticationService::putCompanyOnSession($company);
            AuthenticationService::putGuardOnSession('user');
            
            AuthenticationService::authenticate('user', $user);

            return redirect()->to(AuthenticationService::redirectLoginRoute('user'));
        } catch (Throwable $th) {
            Log::error('Erro ao autenticar em outra empresa', [
                'current_company' => session('auth:company')->id,
                'new_company' => $this->company_id,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Ocorreu um erro ao autenticar. Tente novamente mais tarde.');
        }
    }

    public function openSwitchCompanyModal()
    {
        $this->dispatch('open-switch-company-modal');
    }
    
    public function closeSwitchCompanyModal()
    {
        $this->dispatch('close-switch-company-modal');
    }
}
