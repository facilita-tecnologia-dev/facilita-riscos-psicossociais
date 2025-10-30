<?php

namespace App\Livewire\CMS\Private\Psychosocial\User;

use App\Enums\RoleEnum;
use App\Models\Company;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class UserCreateComponent extends Component
{
    public Company $company;

    public string $name = '';
    public string $cpf = '';
    public string $email = '';
    public string $department = '';
    public string $occupation = '';
    public string $birthDate = '';
    public string $gender = '';
    public string $maritalStatus = '';
    public string $educationLevel = '';
    public string $workShift = '';
    public string $admission = '';
    public string $role = RoleEnum::EMPLOYEE->value;

    public array $roles;

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
            'birthDate' => ['nullable', 'date', Rule::date()->beforeOrEqual(today()->subYears(16)), Rule::date()->after(today()->subCenturies(1))],
            'gender' => ['nullable', 'string', 'max:255'],
            'maritalStatus' => ['nullable', 'string', 'max:255'],
            'educationLevel' => ['nullable', 'string', 'max:255'],
            'workShift' => ['nullable', 'string', 'max:255'],
            'admission' => ['nullable', 'date', Rule::date()->beforeOrEqual(today()), Rule::date()->after(today()->subCenturies(1))],
            'role' => ['required', 'string', Rule::enum(RoleEnum::class)],
        ]);

    
        $user = User::firstWhere('cpf', $this->cpf);

        if($user){
            session('auth:company')->users()->attach($user, ['role_id' => 2]);
        } else{
            $user = User::create([
                'name' => $this->name,
                'cpf' => $this->cpf,
                'email' => $this->email === '' ? $this->email : null,
                'birth_date' => $this->birthDate === '' ? $this->birthDate : null,
                'gender' => $this->gender === '' ? $this->gender : null,
                'marital_status' => $this->maritalStatus === '' ? $this->maritalStatus : null,
                'education_level' => $this->educationLevel === '' ? $this->educationLevel : null,
                'department' => $this->department,
                'occupation' => $this->occupation,
                'work_shift' => $this->workShift === '' ? $this->workShift : null,
                'admission' => $this->admission === '' ? $this->admission : null,
            ]);

            session('auth:company')->users()->attach($user, ['role_id' => $this->role]);

            $role = RoleEnum::from($this->role);
            
            if($role === RoleEnum::MANAGER){
                $user->password = $user->generateTemporaryPassword();
                $user->is_temp_password = true;
                $user->save();
            }
        }

        $this->dispatch('alert:success', 'Funcionário criado!');

        return redirect()->to(route('cms.psychosocial.user.index', $this->company));
    }
}
