<?php

namespace App\Livewire\Private\User;

use App\Enums\User\UserRole;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Throwable;

class UserCreateComponent extends Component
{
    public ?User $user = null;

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
    public string $role = UserRole::EMPLOYEE->value;

    public array $roles;
    public bool $userExists;

    public function render()
    {
        return view('livewire.private.user.user-create-component');
    }

    public function mount()
    {
        $this->roles = array_map(fn ($role) => ['label' => $role->label(), 'value' => $role->value], UserRole::cases());
    }

    public function submit()
    {
        $validatedData = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'max:18', 'cpf', 'unique:users'],
            'email' => ['nullable', 'email', 'max:100'],
            'department' => ['required', 'string', 'max:255'],
            'occupation' => ['required', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date', Rule::date()->beforeOrEqual(today()->subYears(16)), Rule::date()->after(today()->subCenturies(1))],
            'gender' => ['nullable', 'string', 'max:255'],
            'marital_status' => ['nullable', 'string', 'max:255'],
            'education_level' => ['nullable', 'string', 'max:255'],
            'work_shift' => ['nullable', 'string', 'max:255'],
            'admission' => ['nullable', 'date', Rule::date()->beforeOrEqual(today()), Rule::date()->after(today()->subCenturies(1))],
            'role' => ['required', 'string', Rule::enum(UserRole::class)],
        ]);
        
        try {
            UserRepository::store(session('auth:company'), $validatedData);
            $this->dispatch('alert:success', 'Funcionário criado com sucesso!');

            return redirect()->to(route('user.index'));
        } catch (Throwable $th) {
            Log::error('Erro ao criar funcionário', [
                'company' => session('auth:company')->id,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Ocorreu um erro ao criar o funcionário. Tente novamente mais tarde.');
        }
    }

    public function checkUserAlreadyExists()
    {
        $this->validate([
            'cpf' => ['required', 'max:18', 'cpf'],
        ]);

        $user = User::firstWhere('cpf', $this->cpf);

        if ($user) {
            if(session('auth:company')->users()->find($user)){
                $this->dispatch('alert:info', 'Este usuário já está vinculado �� sua empresa!');
            } else {
                $this->user = $user;
                $this->userExists = true;
            }
        } else {
            $this->user = null;
            $this->userExists = false;
            $this->dispatch('alert:info', 'Este usuário ainda não está cadastrado no sistema!');
        }
    }

    public function attachExistingUser()
    {
        $this->validate([
            'role' => ['required', 'string', Rule::enum(UserRole::class)],
        ]);

        try {
            UserRepository::attach(session('auth:company'), $this->user, $this->role);
            $this->dispatch('alert:success', 'Usuário vinculado com sucesso!');

            return redirect()->to(route('user.index'));
        } catch (\Throwable $th) {
            Log::error('Erro ao vincular usuário', [
                'company' => session('auth:company')->id,
                'user' => $this->user,
                'role' => $this->role,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Erro ao vincular usuário.');
        }
    }
}
