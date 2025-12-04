<?php

namespace App\Livewire\Private\User;

use App\Models\Company;
use App\Models\User;
use App\Models\UserDepartmentPermission;
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
    }

    public function submit()
    {
     
    }
}
