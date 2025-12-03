<?php

namespace App\Livewire\Private\Company;

use App\Models\Company;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password as FacadePassword;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class CompanyResetPasswordComponent extends Component
{
    public ?string $password = null;
    public ?string $new_password = null;
    public ?string $new_password_confirmation = null;

    public function render()
    {
        return view('livewire.private.company.company-reset-password-component');
    }

    public function submit()
    {
        $this->validate([
            'password' => ['required', 'string', 'max:100'],
            'new_password' => ['required', 'string', 'max:100', Password::defaults()],
            'new_password_confirmation' => ['required', 'string', 'same:new_password', 'max:100'],
        ]);

        try {
            DB::transaction(function(){
                if(Hash::check($this->password, session('auth:company')->password)){
                    session('auth:company')->forceFill(['password' => Hash::make($this->new_password)]);
                    session('auth:company')->save();

                    $this->dispatch('alert:success', 'Senha redefinida com sucesso!');
                    $this->closeResetPasswordModal();
                    $this->reset(['password', 'new_password', 'new_password_confirmation']);
                } else {
                    $this->dispatch('alert:danger', 'Senha incorreta.');
                }
            });
        } catch (\Throwable $th) {
            Log::error('Erro ao redefinir senha', [
                'company_id' => session('auth:company')->id,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Não foi possível redefinir a senha. Tente novamente mais tarde.');
        }
    }

    public function openResetPasswordModal()
    {
        $this->dispatch('open-report-modal');
    }
    
    public function closeResetPasswordModal()
    {
        $this->dispatch('close-report-modal');
    }
}
