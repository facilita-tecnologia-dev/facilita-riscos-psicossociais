<?php

namespace App\Livewire\Private\Organizational\CustomCollection;

use App\Enums\Campaign\CollectionType;
use App\Models\BaseCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CustomCollectionCreateComponent extends Component
{
    public ?string $name = null;

    public function render()
    {
        return view('livewire.private.organizational.custom-collection.custom-collection-create-component');
    }

    public function createFromDefault()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        try {
            DB::transaction(function(){
                $baseCollection = BaseCollection::where('type', CollectionType::ORGANIZATIONAL->value)->with(['questions'])->first();

                $customCollection =  session('auth:company')->customCollections()->create([
                    'type' => CollectionType::ORGANIZATIONAL->value,
                    'name' => $this->name
                ]);

                foreach($baseCollection->questions as $question){
                    $customCollection->questions()->create([
                        'statement' => $question->statement,
                        'group' => $question->group,
                        'inverted' => 0,
                    ]);
                }
                
                $this->dispatch('custom-collection:create');
                $this->dispatch('alert:success', 'Formulário criado!');
                $this->closeCollectionModal();
            });
        } catch (\Throwable $th) {
            Log::error('Erro ao criar formulário', [
                'company' => session('auth:company')->id,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Erro ao criar formulário.');
        }
    }

    public function openCollectionModal()
    {
        $this->dispatch('open-collection-modal');
    }
    
    public function closeCollectionModal()
    {
        $this->dispatch('close-collection-modal');
    }
}
