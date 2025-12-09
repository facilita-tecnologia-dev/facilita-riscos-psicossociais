<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Storage;
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

    public function downloadDocumentation()
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
        $s3 = Storage::disk('s3');
        
        $file_path = 'documentacao/criterios-para-avaliação-de-riscos-psicossociais.pdf';

        if (! $s3->exists($file_path)) {
            $this->dispatch('alert:danger', 'Arquivo não encontrado, tente novamente mais tarde.');
            return;
        }

        $this->dispatch('alert:success', 'Download feito com sucesso!');
        return $s3->download($file_path);
    }
}
