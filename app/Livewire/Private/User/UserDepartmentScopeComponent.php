<?php

namespace App\Livewire\Private\User;

use App\Models\Company;
use App\Models\User;
use App\Models\UserCustomPermission;
use App\Models\UserDepartmentPermission;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;

class UserDepartmentScopeComponent extends Component
{
    public User $user;

    public array $departmentScopes = [];

    public function render()
    {
        return view('livewire.private.user.user-department-scope-component');
    }

    public function mount(User $user)
    {
        $this->user = $user;

        $companyDepartments = session('auth:company')->users()
            ->select('department')
            ->distinct()
            ->pluck('department');

        $authorizedDepartments = UserDepartmentPermission::where('user_id', $user->id)
            ->where('company_id', session('auth:company')->id)
            ->get();

        foreach($companyDepartments as $department){
            $departmentPermission = $authorizedDepartments->where('department', $department)->first();
            $this->departmentScopes[$department] = $departmentPermission ? (bool) $departmentPermission->allowed : false;
        }
    }

    public function submit()
    {
        try {
            UserRepository::updateDepartmentScopes($this->user, $this->departmentScopes);
            $this->dispatch('alert:success', 'Visão de setores atualizada com sucesso!');
        } catch (\Throwable $th) {
            Log::error('Erro ao atualizar visão de setores', [
                'company' => session('auth:company')->id,
                'user' => $this->user,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Erro ao atualizar visão de setores.');
        }
    }
}
