<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class SidebarComponent extends Component
{
    public bool $isSidebarMobileOpened = false;

    public function render()
    {
        return view('livewire.components.sidebar-component');
    }

    #[On('sidebar:open')]
    public function openSidebar()
    {  
       $this->isSidebarMobileOpened = true; 
    }
}
