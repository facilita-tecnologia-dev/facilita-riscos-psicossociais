<?php

namespace App\Livewire\Cms\Private\Psychosocial\Company;

use App\Enums\Psychosocial\CompanyOrder;
use App\Enums\Filters\UsersCountRange;
use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyIndexComponent extends Component
{
    use WithPagination;

    public $perPage = 8;
    public $filters = [];

    public function render()
    {
        return view('livewire.cms.private.psychosocial.company.company-index-component', [
            'companies' => $this->fetchCompanies()
        ]);
    }

    #[On('company-list:filter')]
    public function updateFilters($filters)
    {
        $this->filters = $filters;
        $this->resetPage();
    }

    #[On('company-list:filter-clear')]
    public function clearFilters()
    {
        $this->reset('filters');
    }

    private function fetchCompanies(): LengthAwarePaginator
    {
        $query = Company::with('campaigns')->withCount([
            'activeUsers as users_count' => function ($query) {
                $query->where('company_user.status', 1);
            },
        ]);

        if (!empty($this->filters['name'])) {
            $query->where('name', 'like', '%' . $this->filters['name'] . '%');
        }

        if (!empty($this->filters['cnpj'])) {
            $query->where('cnpj', 'like', '%' . $this->filters['cnpj'] . '%');
        }
        
        if (!empty($this->filters['UsersCountRange'])) {
            $range = UsersCountRange::from($this->filters['UsersCountRange'])->value;

            if ($range === '200+') {
                $query->having('users_count', '>=', 200);
            } else {
                [$min, $max] = explode('-', $range);
                $query->havingBetween('users_count', [(int)$min, (int)$max]);
            }
        }

        $orderEnum = CompanyOrder::tryFrom($this->filters['orderBy'] ?? CompanyOrder::USERS_DESC->value);

        if ($orderEnum) {
            [$column, $direction] = $orderEnum->config();
            $query->orderBy($column, $direction);
        }
        
        return $query->paginate(8)->onEachSide(1);
    }
}
