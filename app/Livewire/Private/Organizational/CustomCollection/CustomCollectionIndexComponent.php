<?php

namespace App\Livewire\Private\Organizational\CustomCollection;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class CustomCollectionIndexComponent extends Component
{
    public Collection $customCollections;

    public function render()
    {
        return view('livewire.private.organizational.custom-collection.custom-collection-index-component');
    }

    public function mount()
    {
        $this->customCollections = $this->getCustomCollections();
    }

    #[On('custom-collection:create')]
    public function reloadCustomCollections()
    {
        $this->customCollections = $this->getCustomCollections();
    }
    
    public function getCustomCollections()
    {
        return session('auth:company')->customCollections()->get();
    }
}
