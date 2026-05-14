<?php

namespace App\Livewire\Private\Campaign;

use App\Actions\Private\Campaign\SnapshotCampaignEngagementAction;
use App\Enums\Campaign\CampaignStatus;
use App\Models\Campaign;
use App\Repositories\CampaignRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CampaignEditComponent extends Component
{
    public Campaign $campaign;

    public ?string $name = null;
    public ?string $collection = null;
    public ?string $start_date = null;
    public ?string $end_date = null;
    public ?string $description = null;

    public function render()
    {
        return view('livewire.private.campaign.campaign-edit-component');
    }

    public function mount(Campaign $campaign)
    {
        $this->campaign = $campaign;
        $this->name = $this->campaign->name;
        $this->collection = $this->campaign->collection()->type->label();
        $this->start_date = $this->campaign->start_date;
        $this->end_date = $this->campaign->end_date;
        $this->description = $this->campaign->description;
    }

    public function submit()
    {
        $startDateWasChanged = ! $this->campaign->start_date->equalTo(Carbon::parse($this->start_date));
        $startDateRules = ['required', 'date',];

        if ($startDateWasChanged) $startDateRules[] = Rule::date()->afterOrEqual(now());

        $validatedData = $this->validate([
            'name' => ['required', 'string', 'min:8', 'max:255'],
            'start_date' => $startDateRules,
            'end_date' => ['required', 'date', 'after:start_date'],
            'description' => ['nullable', 'string', 'max:512'],
        ]);

        try {
            CampaignRepository::update($this->campaign, $validatedData);
            $this->dispatch('alert:success', 'Campanha atualizada com sucesso!');
            
            return redirect()->to(route('campaign.index'));
        } catch (\Throwable $th) {
            Log::error('Erro ao atualizar campanha', [
                'campaign_id' => $this->campaign->id,
                'name' => $this->name,
                'description' => $this->description,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Erro ao atualizar campanha.');
        }
    }

    public function deleteCampaign()
    {
        try {
            CampaignRepository::delete($this->campaign);
            $this->dispatch('alert:success', 'Campanha excluída com sucesso!');
            
            return redirect()->to(route('campaign.index'));
        } catch (\Throwable $th) {
            Log::error('Erro ao excluir campanha', [
                'campaign_id' => $this->campaign->id,
                'name' => $this->name,
                'description' => $this->description,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Erro ao excluir campanha.');
        }
    }

    public function completeCampaign()
    {
        try {
            $this->campaign->end_date = now();
            $this->campaign->status = CampaignStatus::COMPLETED;
            $this->campaign->save();
            
            app(SnapshotCampaignEngagementAction::class)->execute(session('auth:company'), $this->campaign);
            $this->dispatch('alert:success', 'Campanha finalizada com sucesso!');
            
            return redirect()->to(route('campaign.index'));
        } catch (\Throwable $th) {
            Log::error('Erro ao finalizar campanha', [
                'campaign_id' => $this->campaign->id,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Erro ao finalizar campanha.');
        }
    }
}
