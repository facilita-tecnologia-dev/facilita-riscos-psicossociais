<?php

namespace App\Livewire\Private\ActionPlan;

use App\Enums\RiskInventory\RiskInventoryFormat;
use App\Enums\RiskInventory\RiskInventoryType;
use Livewire\Component;

class GenerateReportComponent extends Component
{
    public string $type = RiskInventoryType::DEPARTMENT->value; 
    public string $format = RiskInventoryFormat::PDF->value; 

    public function render()
    {
        return view('livewire.private.action-plan.generate-report-component');
    }

    public function submit()
    {
        $this->validate([
            'type' => ['required'],
            'format' => ['required'],
        ]);

        return redirect()->to(route('dashboard.psychosocial.risks.report', [$this->type, $this->format]));
    }
}
