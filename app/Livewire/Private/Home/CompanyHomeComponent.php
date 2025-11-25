<?php

namespace App\Livewire\Private\Home;

use App\Enums\BaseCollectionType;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class CompanyHomeComponent extends Component
{
    public Collection | null $scheduledCampaigns;

    public Campaign | null $activePsychosocialCampaign;
    public Campaign | null $activeOrganizationalCampaign;

    public array $remainingSteps;
    public string | null $currentStep;

    public function render()
    {
        return view('livewire.private.home.company-home-component');
    }

    public function mount()
    {
       $baseStepByStep = ['logo', 'import-users', 'schedule-campaign'];

        if (session()->has('remainingSteps')) {
            $this->remainingSteps = session('remainingSteps');
        } else {
            $completedSteps = [
                'logo' => (bool) session('auth:company')->logo,
                'import-users' => session('auth:company')->users->isNotEmpty(),
                'schedule-campaign' => session('auth:company')->campaigns->isNotEmpty(),
            ];

            $lastStepDone = -1;

            foreach ($baseStepByStep as $i => $step) {
                if ($completedSteps[$step]) {
                    $lastStepDone = $i;
                }
            }

            $this->remainingSteps = array_slice($baseStepByStep, $lastStepDone + 1);

            session(['remainingSteps' => $this->remainingSteps]);
        }

        $this->currentStep = $this->remainingSteps[0] ?? null;

        $this->scheduledCampaigns = session('auth:company')->load('campaigns')->scheduledCampaigns();
        $activeCampaigns = session('auth:company')->activeCampaigns();

        $this->activePsychosocialCampaign = $activeCampaigns->filter(fn($campaign) => $campaign->collection()->type == BaseCollectionType::PSYCHOSOCIAL)?->first();
        $this->activeOrganizationalCampaign = $activeCampaigns->filter(fn($campaign) => $campaign->collection()->type == BaseCollectionType::ORGANIZATIONAL)?->first();
    }

    #[On('step-by-step:next')]
    public function nextStep(string $stepToSkip)
    {
        $stepIndex = array_search($stepToSkip, $this->remainingSteps, true);

        if ($stepIndex !== false) {
            unset($this->remainingSteps[$stepIndex]);
            $this->remainingSteps = array_values($this->remainingSteps);
        }

        $this->currentStep = $this->remainingSteps[0] ?? null;

        session(['remainingSteps' => $this->remainingSteps]);
    }
}
