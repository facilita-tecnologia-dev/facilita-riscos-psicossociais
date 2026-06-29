<?php

namespace App\Livewire\Cms\Private\Psychosocial\User;

use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use App\Rules\ValidateCPF;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Throwable;

class UserShowComponent extends Component
{
    public Company $company;

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
        return view('livewire.cms.private.psychosocial.user.user-show-component');
    }

    public function mount()
    {
        $this->roles = array_map(fn ($role) => ['label' => $role->label(), 'value' => $role->value], UserRole::cases());
        $this->role = $this->user->role($this->company)->type;
        $this->status = $this->user->status($this->company);

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
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'max:18', new ValidateCPF, Rule::unique('users', 'cpf')->ignore($this->user->id)],
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
            DB::transaction(function () {
                $this->user->update([
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

                $this->user->companies()->syncWithoutDetaching([$this->company->id => ['role_id' => (int) $this->role]]);

                $role = UserRole::from($this->role);

                if ($role === UserRole::MANAGER && !$this->user->password) {
                    $this->user->password = $this->user->generateTemporaryPassword();
                    $this->user->is_temp_password = true;
                    $this->user->save();
                }

                $this->dispatch('alert:success', 'Funcionário atualizado com sucesso!');
            });
        } catch (Throwable $e) {
            $this->dispatch('alert:danger', 'Ocorreu um erro ao atualizar o funcionário. Tente novamente mais tarde.');
        }
    }

    public function activateUser()
    {
        $this->user->companies()->syncWithoutDetaching([$this->company->id => ['status' => UserStatus::ACTIVE->value]]);
        $this->status = UserStatus::ACTIVE->value;
        $this->dispatch('alert:success', 'Usuário ativado!');
    }

    public function inactivateUser()
    {
        $this->user->companies()->syncWithoutDetaching([$this->company->id => ['status' => UserStatus::INACTIVE->value]]);
        $this->status = UserStatus::INACTIVE->value;
        $this->dispatch('alert:success', 'Usuário inativado!');
    }

    public function copyTempPasswordToClipboard()
    {
        $this->dispatch('alert:success', 'Senha temporária copiada!');
    }
}
