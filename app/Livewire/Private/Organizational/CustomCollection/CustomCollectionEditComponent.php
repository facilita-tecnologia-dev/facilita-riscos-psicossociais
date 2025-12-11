<?php

namespace App\Livewire\Private\Organizational\CustomCollection;

use App\Enums\OC\OCGroup;
use App\Models\CustomCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class CustomCollectionEditComponent extends Component
{
    public CustomCollection $customCollection;
    public array $questions = [];

    public ?string $group = null;

    public array $groups = [];

    protected $listeners = [
        'custom-question:create' => 'refreshQuestions',
        'custom-question:update' => 'refreshQuestions',
        'custom-question:delete' => 'refreshQuestions',
    ];

    public function render()
    {
        return view('livewire.private.organizational.custom-collection.custom-collection-edit-component');
    }

    public function filter()
    {
        $this->validate([
            'group' => ['nullable', Rule::enum(OCGroup::class)],
        ]);

        $this->questions = $this->getQuestions();
        $this->dispatch('alert:success', 'Formulário filtrado!');
    }

    public function mount(CustomCollection $customCollection)
    {
        $this->customCollection = $customCollection;
        $this->questions = $this->getQuestions();

        $this->groups = array_merge([['label' => 'Todos', 'value' => '']], array_map(fn ($group) => ['label' => $group->label(), 'value' => $group->value], OCGroup::cases()));
    }

    public function create(string $group)
    {
        try {
            $this->customCollection->questions()->create([
                'statement' => 'Indefinido',
                'inverted' => 0,
                'group' => $group,
            ]);

            $this->dispatch('custom-question:create');
            $this->dispatch('alert:success', 'Medida adicionada!');
        } catch (\Throwable $th) {
            Log::error('Erro ao criar questão.', [
                'company' => $this->company->id,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Ocorreu um erro ao criar questão. Tente novamente mais tarde.');
        }
    }
    
    public function getQuestions()
    {
        return $this->customCollection
                    ->questions()
                    ->when($this->group, function ($query) {
                        $query->where('group', $this->group);
                    })
                    ->get()
                    ->groupBy('group')
                    ->toArray();
    }

    public function refreshQuestions()
    {
        $this->questions = $this->getQuestions();
    }
}
