<?php

namespace App\Livewire\Private\Organizational\CustomCollection;

use App\Models\CustomQuestion;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CustomCollectionQuestionComponent extends Component
{
    public array $question;

    public ?string $statement = null;

    public function render()
    {
        return view('livewire.private.organizational.custom-collection.custom-collection-question-component');
    }

    public function mount(array $question)
    {
        $this->question = $question;
        $this->statement = $question['statement'];
    }

      public function update()
    {
        try {
            $customQuestion = CustomQuestion::find($this->question['id']);

            $customQuestion->fill([
                'statement'  => $this->statement !== '' ? $this->statement : null,
            ]);
    
            if (! $customQuestion->isDirty()) return;
    
            $customQuestion->save();
    
            $this->dispatch('custom-question:update');
            $this->dispatch('alert:success', 'Questão atualizada!');
        } catch (\Throwable $th) {
            Log::error('Erro ao editar a questão.', [
                'company' => $this->company->id,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Ocorreu um erro ao editar a questão. Tente novamente mais tarde.');
        }
    }

    public function delete()
    {
        try {
            CustomQuestion::find($this->question['id'])->delete();
    
            $this->dispatch('custom-question:delete');
            $this->dispatch('alert:success', 'Questão excluída!');
        } catch (\Throwable $th) {
            Log::error('Erro ao excluir questão.', [
                'company' => $this->company->id,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Ocorreu um erro ao excluir questão. Tente novamente mais tarde.');
        }
    }
}
