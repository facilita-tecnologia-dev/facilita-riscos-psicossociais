<?php

namespace App\Livewire\Private\ActionPlan;

use App\Models\CustomControlAction;
use Livewire\Component;

class ControlActionFormComponent extends Component
{
    public CustomControlAction $action;

    public string $content = '';
    public string $deadline = '';
    public string $assignee = '';
    public string $status = '';

    public function render()
    {
        return view('livewire.private.action-plan.control-action-form-component');
    }

    public function mount(CustomControlAction $action)
    {
        $this->action = $action;
        $this->content = $action->content;

        if($action->deadline) $this->deadline = $action->deadline;
        if($action->assignee) $this->assignee = $action->assignee;
        if($action->status) $this->status = $action->status;
    }

    public function update()
    {
        $this->action->update([
            'content' => $this->content,
            'deadline' => $this->deadline,
            'assignee' => $this->assignee,
            'status' => $this->status,
        ]);

        $this->dispatch('control-action:update');
        $this->dispatch('alert:success', 'Medida atualizada!');
    }

    public function delete()
    {
        $this->action->delete();

        $this->dispatch('control-action:delete');
        $this->dispatch('alert:success', 'Medida excluída!');
    }
}
