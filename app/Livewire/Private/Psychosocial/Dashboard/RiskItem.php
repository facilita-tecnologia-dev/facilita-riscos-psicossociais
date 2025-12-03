<?php

namespace App\Livewire\Private\Psychosocial\Dashboard;

use App\Enums\HSE\HSERisk;
use App\Enums\PROART\PROARTRisk;
use Livewire\Component;

class RiskItem extends Component
{
    public string $hazardName;
    public HSERisk | PROARTRisk $evaluation;
    public array $controlActions;

    public function render()
    {
        return view('livewire.private.psychosocial.dashboard.risk-item');
    }

    public function mount(string $hazardName, HSERisk | PROARTRisk $evaluation, array $controlActions)
    {
        $this->hazardName = $hazardName;
        $this->evaluation = $evaluation;
        $this->controlActions = $controlActions;
    }
}
