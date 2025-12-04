<?php

namespace App\Livewire\Private\User;

use App\Enums\RoleEnum;
use App\Enums\UserStatus;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Throwable;

class UserEditComponent extends Component
{
    public User $user;

    public ?string $name = null;
    public ?string $cpf = null;
    public ?string $email = null;
    public ?string $department = null;
    public ?string $occupation = null;
    public ?string $birth_date = null;
    public ?string $gender = null;
    public ?string $marital_status = null;
    public ?string $education_level = null;
    public ?string $work_shift = null;
    public ?string $admission = null;

    public string $status;
    public string $role;

    public array $roles;

    public function render()
    {
        return view('livewire.private.user.user-edit-component');
    }

    public function mount(User $user)
    {
        $this->user = $user;
        
        $this->roles = array_map(fn ($role) => ['label' => $role->label(), 'value' => $role->value], RoleEnum::cases());
        $this->role = $this->user->role(session('auth:company'))->type;
        $this->status = $this->user->status(session('auth:company'));

        $this->name = $this->user->name;
        $this->cpf = $this->user->cpf;
        $this->email = $this->user->email;
        $this->department = $this->user->department;
        $this->occupation = $this->user->occupation;
        $this->birth_date = $this->user->birth_date;
        $this->gender = $this->user->gender;
        $this->marital_status = $this->user->marital_status;
        $this->education_level = $this->user->education_level;
        $this->work_shift = $this->user->work_shift;
        $this->admission = $this->user->admission;
    }

    public function submit()
    {
        $validatedData = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'max:18', 'cpf', Rule::unique('users', 'cpf')->ignore($this->user->id)],
            'email' => ['nullable', 'email', 'max:100'],
            'department' => ['required', 'string', 'max:255'],
            'occupation' => ['required', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date', Rule::date()->beforeOrEqual(today()->subYears(16)), Rule::date()->after(today()->subCenturies(1))],
            'gender' => ['nullable', 'string', 'max:255'],
            'marital_status' => ['nullable', 'string', 'max:255'],
            'education_level' => ['nullable', 'string', 'max:255'],
            'work_shift' => ['nullable', 'string', 'max:255'],
            'admission' => ['nullable', 'date', Rule::date()->beforeOrEqual(today()), Rule::date()->after(today()->subCenturies(1))],
            'role' => ['required', 'string', Rule::enum(RoleEnum::class)],
        ]);

        try {
            UserRepository::update(session('auth:company'), $this->user, $validatedData);
            
            $this->dispatch('user:updated', $this->user);
            $this->dispatch('alert:success', 'Funcionário atualizado com sucesso!');
        } catch (Throwable $th) {
            Log::error('Erro ao atualizar funcionário', [
                'company' => session('auth:company')->id,
                'user' => $this->user->id,
                'data' => $validatedData,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Ocorreu um erro ao atualizar o funcionário. Tente novamente mais tarde.');
        }
    }

    public function activateUser()
    {
        try {
            UserRepository::activate(session('auth:company'), $this->user);
            $this->status = UserStatus::ACTIVE->value;
            $this->dispatch('alert:success', 'Usuário ativado!');
        } catch (\Throwable $th) {
            Log::error('Erro ao ativar o usuário', [
                'company' => session('auth:company')->id,
                'user' => $this->user->id,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Erro ao ativar o usuário.');
        }
    }

    public function inactivateUser()
    {
        try {
            UserRepository::inactivate(session('auth:company'), $this->user);
            $this->status = UserStatus::INACTIVE->value;
            $this->dispatch('alert:success', 'Usuário inativado!');
        } catch (\Throwable $th) {
            Log::error('Erro ao inativar o usuário', [
                'company' => session('auth:company')->id,
                'user' => $this->user->id,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Erro ao inativar o usuário.');
        }
    }

    public function copyTempPasswordToClipboard()
    {
        $this->dispatch('alert:success', 'Senha temporária copiada!');
    }
}
