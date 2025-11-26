<?php

namespace App\Livewire\Auth\Login;

use App\Models\Company;
use App\Models\User;
use App\Services\AuthenticationService;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class UserLoginComponent extends Component
{
    const STEPS = [
        'CPF'            => 'cpf',
        'SELECT_COMPANY' => 'select-company',
        'TEMP_PASSWORD'  => 'temp-password',
        'NEW_PASSWORD'   => 'new-password',
        'FINAL_PASSWORD' => 'final-password',
    ];

    public string $step = self::STEPS['CPF'];

    public User | null $user;

    public ?string $cpf = null;
    public ?array $companies = null;
    public ?int $selected_company_id = null;

    public bool $is_manager = false;
    public bool $has_temp_password = false;

    public ?string $temp_password = null;
    public ?string $password = null;
    public ?string $new_password = null;
    public ?string $new_password_confirmation = null;

    public function render()
    {
        return view('livewire.auth.login.user-login-component');
    }

    public function submitCPF()
    {
        $credentials = $this->validate([
            'cpf' => ['required', 'max:14', 'cpf'],
        ]);

        $user = User::firstWhere('cpf', $credentials['cpf']);

        if($user) {
            AuthenticationService::putGuardOnSession('user');
            $this->user = $user;

            if(AuthenticationService::checkUserHasMultipleCompanies($user)) {
                $this->companies = $user->companies->toArray();
                $this->step = self::STEPS['SELECT_COMPANY'];

                return;
            } else {
                $this->selected_company_id = $this->companies[0]['id'];
                return $this->checkManager();
                return;
            }
        } else{
            $this->dispatch('alert:danger', 'Este usuário não está cadastrado no sistema');
            return;
        }
        
        $this->dispatch('alert:danger', 'Credenciais incorretas');
    }

    public function selectCompany(string $companyID)
    {
        $this->selected_company_id = $companyID;

        if (!$this->selected_company_id) {
            $this->dispatch('alert:danger', 'Selecione uma empresa.');
            return;
        }

        $company = Company::find($companyID);

        AuthenticationService::putCompanyOnSession($company);

        $this->checkManager();
    }

    private function checkManager()
    {
        $this->is_manager = AuthenticationService::checkUserIsManager($this->user);

        if (! $this->is_manager) {
            AuthenticationService::authenticate('user', $this->user);
            return redirect()->to(AuthenticationService::redirectLoginRoute('user'));
        }

        $this->has_temp_password = $this->user->is_temp_password;

        if ($this->has_temp_password) {
            $this->step = self::STEPS['TEMP_PASSWORD'];
            return;
        }

        $this->step = self::STEPS['FINAL_PASSWORD'];
    }

    public function validateTemporaryPassword()
    {
        $this->validate([
            'temp_password' => ['required', 'string', 'max:100'],
        ]);

        $isValid = AuthenticationService::checkTempPassword($this->temp_password, $this->user->password);

        if (! $isValid) {
            $this->dispatch('alert:danger', 'Senha temporária incorreta.');
            return;
        }

        $this->step = self::STEPS['NEW_PASSWORD'];
    }

    public function updatePassword()
    {
        $this->validate([
            'new_password' => ['required', 'string', 'max:100', Password::defaults()],
            'new_password_confirmation' => ['required', 'string', 'same:new_password', 'max:100'],
        ]);

        $credentials = [
            'current_password' => $this->user->password,
            'new_password' => $this->new_password,
        ];

        if(AuthenticationService::resetPassword('user', $this->user, $credentials)){  
            AuthenticationService::authenticate('user', $this->user);
            $this->dispatch('alert:success', 'Senha redefinida com sucesso!');

            return redirect()->to(AuthenticationService::redirectLoginRoute('user'));
        };
        
        $this->dispatch('alert:danger', 'Não foi possível redefinir sua senha.');
    }

    public function validateFinalPassword()
    {
        $this->validate([
            'password' => ['required', 'string', 'max:100'],
        ]);

        $isValid = AuthenticationService::checkPassword($this->password, $this->user->password);

        if (!$isValid) {
            $this->dispatch('alert:danger', 'Senha incorreta.');
            return;
        }

        AuthenticationService::authenticate('user', $this->user);
        $this->dispatch('alert:success', 'Autenticado com sucesso!');

        return redirect()->to(AuthenticationService::redirectLoginRoute('user'));
    }
}
