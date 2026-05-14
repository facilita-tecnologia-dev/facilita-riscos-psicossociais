<?php

namespace App\Livewire\Private\Home;

use App\Repositories\CampaignRepository;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CompanyHomeScheduleCampaignComponent extends Component
{
    public ?string $name = null;
    public ?string $collection_id = null;
    public ?string $start_date = null;
    public ?string $end_date = null;
    public ?string $description = null;

    public array $collections;

    public function render()
    {
        return view('livewire.private.home.company-home-schedule-campaign-component');
    }

    public function mount()
    {
        $psychosocialCollection = session('auth:company')->psychosocialCollection();
        $this->collection_id =  $psychosocialCollection->id;

        $this->collections = [
            [
                'label' => $psychosocialCollection->name,
                'value' => 'base_' . $psychosocialCollection->id,
            ]
        ];
    }

    public function nextStep()
    {
        $this->dispatch('step-by-step:next', 'schedule-campaign');
    }

    public function submit()
    {
        $validatedData = $this->validate([
            'name' => ['required', 'string', 'min:8', 'max:255'],
            'collection_id' => ['required'],
            'start_date' => ['required', 'date', Rule::date()->afterOrEqual(now())],
            'end_date' => ['required', 'date', 'after:start_date'],
            'description' => ['nullable', 'string'],
        ]);

        if (session('auth:company')->hasOverlappingCampaign($this->collection_id, 'base', $validatedData['start_date'], $validatedData['end_date'])) {
            $this->dispatch('alert:danger', 'Já existe uma campanha deste tipo agendada/em andamento neste período.');
            return;
        }

        try {
            CampaignRepository::store($validatedData);

            $this->dispatch('alert:success', 'Campanha agendada com sucesso!');
            session()->flash('message', 'Você concluiu todo o passo a passo inicial. Agora, pode continuar utilizando todas as demais funcionalidades do sistema.');
            
            $this->nextStep();
        } catch (\Throwable $th) {
            report($th);
            $this->dispatch('alert:danger', 'Não foi possível realizar o agendamento da campanha.');
        }
    }
}
