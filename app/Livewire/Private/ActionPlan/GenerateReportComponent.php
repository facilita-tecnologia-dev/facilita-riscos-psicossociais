<?php

namespace App\Livewire\Private\ActionPlan;

use App\Enums\PsychosocialReportFormatTypes;
use App\Enums\PsychosocialReportTypes;
use App\Services\PsychosocialReportService;
use App\Services\PsychosocialService;
use Livewire\Component;

class GenerateReportComponent extends Component
{
    public string $type = PsychosocialReportTypes::DEPARTMENT->value; 
    public string $format = PsychosocialReportFormatTypes::PDF->value; 

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
