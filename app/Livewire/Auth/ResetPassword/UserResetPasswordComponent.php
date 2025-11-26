<?php

namespace App\Livewire\Auth\ResetPassword;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password as FacadePassword;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class UserResetPasswordComponent extends Component
{
    public ?string $email = null;  
    public ?string $token = null;      
    public ?string $password = null;  
    public ?string $password_confirmation = null;      

    public function render()
    {
        return view('livewire.auth.reset-password.user-reset-password-component');
    }

    public function mount(string $email, string $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    public function submit()
    {
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'max:100', Password::defaults()],
            'password_confirmation' => ['required', 'string', 'same:password', 'max:100'],
        ]);

        $status = FacadePassword::broker('users')->reset( // 👈 usa o broker certo
            ['email' => $this->email, 'token' => $this->token, 'password' => $this->password, 'password_confirmation' => $this->password_confirmation],
            function (User $user, string $password) {
                $user->forceFill(['password' => Hash::make($password)]);
                $user->save();
    
                event(new PasswordReset($user));
            }
        );

        if(!$status === FacadePassword::PasswordReset) return $this->dispatch('alert:danger', 'Não foi possível redefinir a senha. Tente novamente mais tarde.');

        $this->dispatch('alert:success', 'Senha redefinida com sucesso');
        return redirect()->to(route('user.login'));
    }
}
