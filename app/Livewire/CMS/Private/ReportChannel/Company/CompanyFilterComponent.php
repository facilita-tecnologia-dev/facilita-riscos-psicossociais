<?php

namespace App\Livewire\CMS\Private\ReportChannel\Company;

use App\Enums\Filters\CompanyOrder;
use Livewire\Component;

class CompanyFilterComponent extends Component
{
    public $name = '';
    public $cnpj = '';
    public $userCountRange = '';
    public $orderBy = CompanyOrder::USERS_DESC->value;

    public function render()
    {
        return view('livewire.cms.private.report-channel.company.company-filter-component');
    }

    public function submit()
    {
        $filters = $this->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'cnpj' => ['nullable', 'string', 'max:255'],
            // 'userCountRange' => ['nullable', new Enum(UsersCountRangeEnum::class)],
            // 'orderBy' => ['nullable', new Enum(CompanyOrder::class)],
        ]);

        $this->dispatch('company-list:filter', $filters);
        $this->dispatch('alert:success', 'Lista de empresas filtrada!');
    }

    public function clear()
    {
        $this->reset(['name', 'cnpj']);
        $this->dispatch('company-list:filter-clear');
        $this->dispatch('alert:success', 'Filtros removidos!');
    }
}
