<?php

namespace App\Livewire\Private\Campaign;

use App\Enums\Campaign\CollectionType;
use App\Models\BaseCollection;
use App\Models\CustomCollection;
use App\Repositories\CampaignRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CampaignCreateComponent extends Component
{
    public ?string $name = null;
    public ?string $collection_id = null;
    public ?string $start_date = null;
    public ?string $end_date = null;
    public ?string $description = null;

    public array $collections = [];

    public function render()
    {
        return view('livewire.private.campaign.campaign-create-component');
    }

    public function mount()
    {
        $customCollections = session('auth:company')->customCollections()->get();
        $baseCollections = session('auth:company')->baseCollections();

        if(session('auth:company')->can_access_organizational){
            $this->collections = $baseCollections
                            ->concat($customCollections)
                            ->map(fn($collection) => [
                                    'label' => $collection->name, 
                                    'value' => ($collection instanceof CustomCollection ? 'custom_' : 'base_') . $collection->id
                                ]
                            )
                            ->values()
                            ->toArray();
        } else {
            $this->collections = $baseCollections->where('type', CollectionType::PSYCHOSOCIAL->value)
                           ->map(fn($collection) => [
                                    'label' => $collection->name, 
                                    'value' => ($collection instanceof CustomCollection ? 'custom_' : 'base_') . $collection->id
                                ]
                            )
                            ->values()
                            ->toArray();;
        }
    }

    public function submit()
    {
        $validatedData = $this->validate([
            'name' => ['required', 'string', 'min:8', 'max:255'],
            'collection_id' => ['required'],
            'start_date' => ['required', 'date',    function ($attribute, $value, $fail) {
                if (Carbon::createFromFormat('Y-m-d\TH:i', $value)->lt(now()->addMinutes(5))) {
                    $fail('A data inicial deve ser pelo menos 5 minutos após o horário atual.');}
            }
            ],
            'end_date' => ['required', 'date', 'after:start_date'],
            'description' => ['nullable', 'string', 'max:512'],
        ]);

        try {
            [$collection_type, $collection_id] = explode('_', $this->collection_id);

            if (session('auth:company')->hasOverlappingCampaign($collection_id, $collection_type, $validatedData['start_date'], $validatedData['end_date'])) {
                $this->dispatch('alert:danger', 'Já existe uma campanha deste tipo agendada/em andamento neste período.');
                return;
            }

            CampaignRepository::store($validatedData);

            $this->dispatch('alert:success', 'Campanha agendada com sucesso!');
            
            return redirect()->to(route('campaign.index'));
        } catch (\Throwable $th) {
            Log::error('Erro ao criar campanha', [
                'name' => $this->name,
                'description' => $this->description,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Erro ao agendar campanha.');
        }
    }
}
