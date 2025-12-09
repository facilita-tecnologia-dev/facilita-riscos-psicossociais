<?php

namespace App\Livewire\Private\Organizational\Dashboard;

use App\Enums\Campaign\CollectionType;
use App\Enums\Campaign\CampaignStatus;
use App\Enums\OC\OCEvaluation;
use App\Enums\OC\OCVisualization;
use App\Models\Campaign;
use App\Services\Organizational\OrganizationalService;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class OrganizationalDashboardComponent extends Component
{
    public Campaign | null $organizationalCampaign;
    public array | null $organizationalResults;

    public Collection $engagement;

    public string $evaluation_type = OCEvaluation::DEPARTMENT->value;
    public string $visualization_type = OCVisualization::GENERAL->value;

    public array $filters = [];

    public function render()
    {
        return view('livewire.private.organizational.dashboard.organizational-dashboard-component');
    }

    public function mount()
    {
        $this->organizationalCampaign = session('auth:company')->campaigns()->whereYear('start_date', now()->year)->get()->filter(fn($campaign) => $campaign->collection()->type == CollectionType::ORGANIZATIONAL && $campaign->status !== CampaignStatus::SCHEDULED)?->first();
        
        if($this->organizationalCampaign){
            $this->organizationalResults = $this->getDashboardResults();
            $this->engagement = OrganizationalService::engagement($this->organizationalCampaign, $this->evaluation_type);
        }
    }

    #[On('organizational-evaluation:update-visualization')]
    public function updateVisualization(string $visualization_type)
    {   
        $this->visualization_type = $visualization_type;
        $this->organizationalResults = $this->getDashboardResults();
    }

    #[On('organizational-evaluation:update')]
    public function updateEvaluation(string $evaluation_type)
    {   
        $this->evaluation_type = $evaluation_type;

        $this->organizationalResults = $this->getDashboardResults();
        $this->engagement = OrganizationalService::engagement($this->organizationalCampaign, $this->evaluation_type);
    }

    #[On('organizational-evaluation:filter')]
    public function filterEvaluation(array $filters)
    {
        $this->filters = $filters;
        $this->organizationalResults = $this->getDashboardResults();
    }

    private function getDashboardResults()
    {
        return $this->organizationalCampaign 
                    ? OrganizationalService::dashboard($this->organizationalCampaign, $this->evaluation_type, $this->visualization_type, $this->filters) 
                    : collect();
    }
}
