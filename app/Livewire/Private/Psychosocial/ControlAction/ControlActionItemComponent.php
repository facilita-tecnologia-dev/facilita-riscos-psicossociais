<?php

namespace App\Livewire\Private\Psychosocial\ControlAction;

use App\Models\CustomControlAction;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ControlActionItemComponent extends Component
{
    public $action;

    public string $content = '';
    public string $deadline = '';
    public string $assignee = '';
    public string $status = '';

    public function render()
    {
        return view('livewire.private.psychosocial.control-action.control-action-item-component');
    }

    public function mount(array $action)
    {
        // $this->action = CustomControlAction::find($action['id']);
        // $this->content = $action['content'];
        
        // if($action['deadline']) $this->deadline = $action['deadline'];
        // if($action['assignee']) $this->assignee = $action['assignee'];
        // if($action['status']) $this->status = $action['status'];

        $this->action = CustomControlAction::findOrFail($action['id']);

        $this->content  = $this->action->content ?? '';
        $this->deadline = $this->action->deadline ?? '';
        $this->assignee = $this->action->assignee ?? '';
        $this->status   = $this->action->status ?? '';
    }

    public function update()
    {
        try {
            $this->action->fill([
                'content'  => $this->content !== '' ? $this->content : null,
                'deadline' => $this->deadline !== '' ? $this->deadline : null,
                'assignee' => $this->assignee !== '' ? $this->assignee : null,
                'status'   => $this->status !== '' ? $this->status : null,
            ]);
    
            if (! $this->action->isDirty()) return;
    
            $this->action->save();

            $this->action->refresh();

            $this->content  = $this->action->content ?? '';
            $this->deadline = $this->action->deadline ?? '';
            $this->assignee = $this->action->assignee ?? '';
            $this->status   = $this->action->status ?? '';
    
            $this->dispatch('control-action:update', $this->action->load(['hazard', 'type'])->toArray());
            $this->dispatch('alert:success', 'Medida atualizada!');
        } catch (\Throwable $th) {
            Log::error('Erro ao editar medida de controle.', [
                'company' => $this->company->id,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Ocorreu um erro ao editar medida de controle. Tente novamente mais tarde.');
        }
    }

    public function delete()
    {
        try {
            $actionID = $this->action->id;
            $this->action->delete();
    
            $this->dispatch('control-action:delete', $actionID);
            $this->dispatch('alert:success', 'Medida excluída!');
        } catch (\Throwable $th) {
            Log::error('Erro ao excluir medida de controle.', [
                'company' => $this->company->id,
                'error' => $th->getMessage(),
                'trace' => $th->getTraceAsString(),
            ]);

            $this->dispatch('alert:danger', 'Ocorreu um erro ao excluir medida de controle. Tente novamente mais tarde.');
        }

    }
}
