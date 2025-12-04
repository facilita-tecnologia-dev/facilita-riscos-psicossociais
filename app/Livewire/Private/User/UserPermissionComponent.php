<?php

namespace App\Livewire\Private\User;

use App\Models\Permission;
use App\Models\RolePermission;
use App\Models\User;
use App\Models\UserCustomPermission;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class UserPermissionComponent extends Component
{
    public User $user;

    public array $permissions = [];

    public $defaultRolePermissions;
    public $currentUserPermissions;

    public function render()
    {
        return view('livewire.private.user.user-permission-component');
    }

    public function mount(User $user)
    {
        $this->user = $user;

        $this->defaultRolePermissions = RolePermission::where('role_id', $user->roles[0]->id)
            ->with('permission')
            ->get();

        $this->currentUserPermissions = UserCustomPermission::where('user_id', $user->id)
            ->with('permission')
            ->where('company_id', session('auth:company')->id)
            ->get();

        foreach ($this->defaultRolePermissions as $default) {
            $custom = $this->currentUserPermissions
                ->firstWhere('permission_id', $default->permission_id);

            $model = $custom ?? $default;

            $key = $model->permission->key_name;

            $this->permissions[$key] = [
                'id'      => $model->permission->id,
                'label'   => $model->permission->name,
                'description' => $model->permission->description,
                'allowed' => (bool) $model->allowed,
            ];
        }

        uasort($this->permissions, fn($a, $b) =>
            $b['allowed'] <=> $a['allowed']
        );
    }

    public function submit()
    {
        try {
            UserRepository::updatePermissions($this->user, $this->defaultRolePermissions, $this->currentUserPermissions, $this->permissions);
            $this->dispatch('alert:success', 'Permissões atualizadas com sucesso!');
        } catch (\Throwable $th) {
            Log::error('Erro ao criar campanha', [
                'company' => session('auth:company')->id,
                'user' => $this->user,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Erro ao atualizar as permissões.');
        }
    }
}
