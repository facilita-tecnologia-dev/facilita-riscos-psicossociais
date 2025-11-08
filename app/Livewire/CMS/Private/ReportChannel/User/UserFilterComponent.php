<?php

namespace App\Livewire\CMS\Private\ReportChannel\User;

use App\Enums\Filters\ReportChannelUserOrder;
use App\Enums\ReportChannel\ReportChannelUserTypes;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;

class UserFilterComponent extends Component
{
    public $full_name = '';
    public $cpf = '';
    public $type = '';
    public $order_by = ReportChannelUserOrder::NAME_ASC->value;

    public $userTypes = [];
    public $userOrderTypes = [];

    public function render()
    {
        return view('livewire.cms.private.report-channel.user.user-filter-component');
    }

    public function mount()
    {
        $this->userOrderTypes = array_map(fn ($userOrderType) => ['label' => $userOrderType->label(), 'value' => $userOrderType->value], ReportChannelUserOrder::cases());
        $this->userTypes = array_merge([['label' => 'Todos', 'value' => '']], array_map(fn ($userType) => ['label' => $userType->label(), 'value' => $userType], ReportChannelUserTypes::cases()));
    }

    public function submit()
    {
        $filters = $this->validate([
            'full_name' => ['nullable', 'string', 'max:255'],
            'cpf' => ['nullable', 'string', 'max:255'],
            'type' => ['nullable', 'string', 'max:255'],
            'order_by' => ['nullable', new Enum(ReportChannelUserOrder::class)],
        ]);

        $this->dispatch('user-list:filter', $filters);
        $this->dispatch('alert:success', 'Lista de empresas filtrada!');
    }

    public function clear()
    {
        $this->reset(['full_name', 'cpf', 'type']);
        $this->dispatch('user-list:filter-clear');
        $this->dispatch('alert:success', 'Filtros removidos!');
    }
}
