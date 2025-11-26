<?php

namespace App\Livewire\Auth\ForgotPassword;

use App\Models\User;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class UserForgotPasswordComponent extends Component
{
    public ?string $email = null;

    public function render()
    {
        return view('livewire.auth.forgot-password.user-forgot-password-component');
    }

    public function submit()
    {
        $this->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::firstWhere('email', $this->email);

        if(!$user || !$user->email) return $this->dispatch('alert:danger', 'Não existe um usuário com esse e-mail cadastrado no sistema.');

        $status = Password::broker('users')->sendResetLink(['email' => $this->email], fn ($user, $token) => $user->sendPasswordResetNotification($token, 'user'));

        return $status === Password::ResetLinkSent
        ? $this->dispatch('alert:success', 'E-mail de redefinição enviado!')
        : $this->dispatch('alert:danger', 'Não foi possível enviar um e-mail de redefinição. Tente novamente mais tarde.');
    }
}
