<?php

namespace App\Livewire\CMS\Private\Psychosocial\User;

use App\Enums\Filters\UserOrder;
use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndexComponent extends Component
{
    use WithPagination;

    public Company $company;

    public $perPage = 8;
    public $filters = [];

    public function render()
    {
        return view('livewire.cms.private.psychosocial.user.user-index-component', [
            'users' => $this->fetchUsers()
        ]);
    }

    #[On('user-list:filter')]
    public function updateFilters($filters)
    {
        $this->filters = $filters;
        $this->resetPage();
    }

    #[On('user-list:filter-clear')]
    public function clearFilters()
    {
        $this->reset('filters');
    }

    private function fetchUsers(): LengthAwarePaginator
    {
        $query = $this->company->users();

        if (!empty($this->filters['name'])) {
            $query->where('name', 'like', '%' . $this->filters['name'] . '%');
        }

        if (!empty($this->filters['cpf'])) {
            $query->where('cpf', 'like', '%' . $this->filters['cpf'] . '%');
        }

        if (!empty($this->filters['department'])) {
            $query->where('department', $this->filters['department']);
        }

        $orderEnum = UserOrder::tryFrom($this->filters['orderBy'] ?? UserOrder::NAME_ASC->value);

        if ($orderEnum) {
            [$column, $direction] = $orderEnum->config();
            $query->orderBy($column, $direction);
        }

        return $query->paginate(8)->onEachSide(1);
    }
}
