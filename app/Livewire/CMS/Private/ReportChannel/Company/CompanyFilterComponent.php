<?php

namespace App\Livewire\Cms\Private\ReportChannel\Company;

use App\Enums\ReportChannel\CompanyOrder;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;

class CompanyFilterComponent extends Component
{
    public $register_name = '';
    public $cnpj = '';
    public $order_by = CompanyOrder::REGISTER_NAME_ASC->value;

    public $companyOrderTypes = [];

    public function render()
    {
        return view('livewire.cms.private.report-channel.company.company-filter-component');
    }

    public function mount()
    {
        $this->companyOrderTypes = array_map(fn ($companyOrderType) => ['label' => $companyOrderType->label(), 'value' => $companyOrderType->value], CompanyOrder::cases());
    }

    public function submit()
    {
        $filters = $this->validate([
            'register_name' => ['nullable', 'string', 'max:255'],
            'cnpj' => ['nullable', 'string', 'max:255'],
            'order_by' => ['nullable', new Enum(CompanyOrder::class)],
        ]);

        $this->dispatch('company-list:filter', $filters);
        $this->dispatch('alert:success', 'Lista de empresas filtrada!');
    }

    public function clear()
    {
        $this->reset(['register_name', 'cnpj']);
        $this->dispatch('company-list:filter-clear');
        $this->dispatch('alert:success', 'Filtros removidos!');
    }
}
