<?php

namespace App\Livewire\Auth\ForgotPassword;

use App\Models\Company;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class CompanyForgotPasswordComponent extends Component
{
    public ?string $email = null;

    public function render()
    {
        return view('livewire.auth.forgot-password.company-forgot-password-component');
    }

    public function submit()
    {
        $this->validate([
            'email' => ['required', 'email'],
        ]);


        $company = Company::firstWhere('email', $this->email);

        if(!$company || !$company->email) return $this->dispatch('alert:danger', 'Não existe uma empresa com esse e-mail cadastrada no sistema.');

        $status = Password::broker('companies')->sendResetLink(['email' => $this->email], fn ($company, $token) => $company->sendPasswordResetNotification($token, 'company'));

        return $status === Password::ResetLinkSent
        ? $this->dispatch('alert:success', 'E-mail de redefinição enviado!')
        : $this->dispatch('alert:danger', 'Não foi possível enviar um e-mail de redefinição. Tente novamente mais tarde.');
    }
}
