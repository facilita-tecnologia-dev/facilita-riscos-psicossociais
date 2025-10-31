<?php

namespace App\Livewire\CMS\Private\Psychosocial\User;

use App\Enums\RoleEnum;
use App\Models\Company;
use App\Models\User;
use Error;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Throwable;

class UserCreateComponent extends Component
{
    public Company $company;
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
    public string $role = RoleEnum::EMPLOYEE->value;

    public array $roles;
    public bool $userExists;

    public function render()
    {
        return view('livewire.cms.private.psychosocial.user.user-create-component');
    }


    public function mount()
    {
        $this->roles = array_map(fn ($role) => ['label' => $role->label(), 'value' => $role->value], RoleEnum::cases());
    }

    public function submit()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'max:18', 'cpf'],
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
            DB::transaction(function () {
                $user = User::create([
                    'name' => $this->name,
                    'cpf' => $this->cpf,
                    'email' => $this->email,
                    'birth_date' => $this->birth_date,
                    'gender' => $this->gender,
                    'marital_status' => $this->marital_status,
                    'education_level' => $this->education_level,
                    'department' => $this->department,
                    'occupation' => $this->occupation,
                    'work_shift' => $this->work_shift,
                    'admission' => $this->admission,
                ]);

                $this->company->users()->attach($user, ['role_id' => $this->role]);

                $role = RoleEnum::from($this->role);

                if ($role === RoleEnum::MANAGER) {
                    $user->password = $user->generateTemporaryPassword();
                    $user->is_temp_password = true;
                    $user->save();
                }

                $this->dispatch('alert:success', 'Funcionário criado com sucesso!');
            });
            return redirect()->to(route('cms.psychosocial.user.index', $this->company));
        } catch (Throwable $e) {
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
            if($this->company->users->find($user)){
                $this->dispatch('alert:info', 'Este usuário já está vinculado à sua empresa!');
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
            'role' => ['required', 'string', Rule::enum(RoleEnum::class)],
        ]);

        $this->company->users()->attach($this->user, ['role_id' => $this->role]);
        $this->dispatch('alert:success', 'Usuário vinculado com sucesso!');
        
        return redirect()->to(route('cms.psychosocial.user.index', $this->company));
    }
}
