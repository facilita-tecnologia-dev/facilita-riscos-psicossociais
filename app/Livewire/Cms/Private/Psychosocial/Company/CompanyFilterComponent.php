<?php

namespace App\Livewire\Cms\Private\Psychosocial\Company;

use App\Enums\Psychosocial\CompanyOrder;
use App\Enums\Filters\UsersCountRange;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;

class CompanyFilterComponent extends Component
{
    public $name = '';
    public $cnpj = '';
    public $UsersCountRange = '';
    public $orderBy = CompanyOrder::USERS_DESC->value;

    public $UsersCountRanges = [];
    public $companyOrderTypes = [];

    public function render()
    {
        return view('livewire.cms.private.psychosocial.company.company-filter-component');
    }


    public function mount()
    {
        $this->UsersCountRanges = array_merge([['label' => 'Todos', 'value' => '']], array_map(fn ($UsersCountRange) => ['label' => $UsersCountRange->value . ' funcionários', 'value' => $UsersCountRange->value], UsersCountRange::cases()));
        $this->companyOrderTypes = array_map(fn ($companyOrderType) => ['label' => $companyOrderType->label(), 'value' => $companyOrderType->value], CompanyOrder::cases());
    }

    public function submit()
    {
        $filters = $this->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'cnpj' => ['nullable', 'string', 'max:255'],
            'UsersCountRange' => ['nullable', new Enum(UsersCountRange::class)],
            'orderBy' => ['nullable', new Enum(CompanyOrder::class)],
        ]);

        $this->dispatch('company-list:filter', $filters);
        $this->dispatch('alert:success', 'Lista de empresas filtrada!');
    }

    public function clear()
    {
        $this->reset(['name', 'cnpj', 'UsersCountRange']);
        $this->dispatch('company-list:filter-clear');
        $this->dispatch('alert:success', 'Filtros removidos!');
    }
}
