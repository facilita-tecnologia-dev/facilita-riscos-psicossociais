<?php

namespace App\Livewire\CMS\Private\ReportChannel\Company;

use App\Models\Company;
use App\Services\ReportChannelService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyIndexComponent extends Component
{
    // use WithPagination;

    public $filters = [];

    public function render()
    {
        return view('livewire.cms.private.report-channel.company.company-index-component', [
            'companies' => $this->fetchCompanies()
        ]);
    }

    #[On('company-list:filter')]
    public function updateFilters($filters)
    {
        $this->filters = $filters;
    }

    #[On('company-list:filter-clear')]
    public function clearFilters()
    {
        $this->reset('filters');
    }

    private function fetchCompanies(): mixed
    {
        $response = ReportChannelService::companies();
        // if (!empty($this->filters['name'])) {
        //     $query->where('name', 'like', '%' . $this->filters['name'] . '%');
        // }

        // if (!empty($this->filters['cnpj'])) {
        //     $query->where('cnpj', 'like', '%' . $this->filters['cnpj'] . '%');
        // }
        
        // if (!empty($this->filters['userCountRange'])) {
        //     $range = UsersCountRangeEnum::from($this->filters['userCountRange'])->value;

        //     if ($range === '200+') {
        //         $query->having('users_count', '>=', 200);
        //     } else {
        //         [$min, $max] = explode('-', $range);
        //         $query->havingBetween('users_count', [(int)$min, (int)$max]);
        //     }
        // }

        // $orderEnum = CompanyOrder::tryFrom($this->filters['orderBy'] ?? CompanyOrder::USERS_DESC->value);

        // if ($orderEnum) {
        //     [$column, $direction] = $orderEnum->config();
        //     $query->orderBy($column, $direction);
        // }
        
        return $response;
    }

}
