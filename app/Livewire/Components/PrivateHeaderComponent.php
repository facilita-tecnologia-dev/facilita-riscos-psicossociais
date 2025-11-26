<?php

namespace App\Livewire\Components;

use App\Services\AuthenticationService;
use Livewire\Component;

class PrivateHeaderComponent extends Component
{
    public function render()
    {
        return view('livewire.components.private-header-component');
    }

    public function openSidebar()
    {
        $this->dispatch('sidebar:open');
    }

    public function logout()
    {
        $redirectRoute = AuthenticationService::logout(request());
        return redirect()->to($redirectRoute);
    }
}
