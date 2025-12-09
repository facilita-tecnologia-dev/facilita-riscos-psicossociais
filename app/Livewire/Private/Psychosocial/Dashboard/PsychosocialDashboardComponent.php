<?php

namespace App\Livewire\Private\Psychosocial\Dashboard;

use App\Enums\Campaign\CollectionType;
use App\Enums\Campaign\CampaignStatus;
use App\Enums\Campaign\EvaluationTypes;
use App\Models\Campaign;
use App\Services\Psychosocial\PsychosocialService;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class PsychosocialDashboardComponent extends Component
{
    public Campaign | null $psychosocialCampaign;
    public Collection | null $psychosocialResults;

    public Collection $engagement;

    public string $evaluation_type = EvaluationTypes::DEPARTMENT->value;
    public ?string $department = null;
    public ?string $occupation = null;

    public array $filters = [];

    public function render()
    {
        return view('livewire.private.psychosocial.dashboard.psychosocial-dashboard-component');
    }

    public function mount()
    {
        $this->psychosocialCampaign = session('auth:company')->campaigns()->whereYear('start_date', now()->year)->get()->filter(fn($campaign) => $campaign->collection()->type == CollectionType::PSYCHOSOCIAL && $campaign->status !== CampaignStatus::SCHEDULED)?->first();
        
        if($this->psychosocialCampaign){
            $this->psychosocialResults = $this->getDashboardResults();
            $this->engagement = PsychosocialService::engagement($this->psychosocialCampaign, $this->evaluation_type);
        }
    }

    #[On('psychosocial-evaluation:update')]
    public function updateEvaluation(string $evaluation_type, ?string $element = null)
    {   
        $this->evaluation_type = $evaluation_type;

        if($evaluation_type === EvaluationTypes::DEPARTMENT->value && $element){
            $this->department = $element;
            $this->occupation = null;
        }
        
        if($evaluation_type === EvaluationTypes::OCCUPATION->value && $element){
            $this->occupation = $element;
            $this->department = null;
        }

        $this->psychosocialResults = $this->getDashboardResults();
        $this->engagement = PsychosocialService::engagement($this->psychosocialCampaign, $this->evaluation_type);
    }

    #[On('psychosocial-evaluation:filter')]
    public function filterEvaluation(array $filters)
    {
        $this->filters = $filters;
        $this->psychosocialResults = $this->getDashboardResults();
    }

    private function getDashboardResults()
    {
        return $this->psychosocialCampaign 
                    ? PsychosocialService::dashboard($this->psychosocialCampaign, $this->evaluation_type, ($this->evaluation_type === EvaluationTypes::DEPARTMENT->value ? $this->department : $this->occupation), $this->filters) 
                    : collect();
    }
}
