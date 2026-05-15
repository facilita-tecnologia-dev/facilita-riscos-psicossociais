<?php

namespace App\Livewire\Private\Psychosocial\Indicator;

use Livewire\Component;

class IndicatorIndexComponent extends Component
{
    public string $tab = 'absences';

    public function render()
    {    
        return view('livewire.private.psychosocial.indicator.indicator-index-component');
    }
}
