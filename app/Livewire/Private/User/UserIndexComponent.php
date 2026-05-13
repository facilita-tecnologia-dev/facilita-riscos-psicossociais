<?php

namespace App\Livewire\Private\User;

use App\Enums\Psychosocial\UserOrder;
use App\Models\Campaign;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class UserIndexComponent extends Component
{
    public ?Campaign $latestPsychosocialCampaign = null;
    public ?Campaign $latestOrganizationalCampaign = null;

    public $filters = [];

    public array $allowedDepartments = [];

    public function render()
    {
        return view('livewire.private.user.user-index-component', [
            'users' => $this->fetchUsers()
        ]);
    }

    public function mount()
    {
        $this->latestPsychosocialCampaign = session("auth:company")->latestPsychosocialCampaign() ?? null;
        $this->latestOrganizationalCampaign = session("auth:company")->latestOrganizationalCampaign() ?? null;

        if (session('auth:guard') === 'user') {
            $this->allowedDepartments = session('auth:user')->getDepartmentScopes(session('auth:user'));
        }
    }

    #[On('user-list:filter')]
    public function updateFilters($filters)
    {
        $this->filters = $filters;
    }

    #[On('user-list:filter-clear')]
    public function clearFilters()
    {
        $this->reset('filters');
    }

    private function fetchUsers(): Collection
    {

        $query = session("auth:company")->allUsers()
                ->when(
                    session('auth:guard') === 'user', 
                    fn($q) => $q->whereIn('department', $this->allowedDepartments)->whereNotNull('department')->where('department', '!=', '')
                );

        if (!empty($this->filters['name'])) {
            $query->where('name', 'like', '%' . $this->filters['name'] . '%');
        }

        if (!empty($this->filters['department'])) {
            $query->where('department', $this->filters['department']);
        }

        $orderEnum = UserOrder::tryFrom($this->filters['orderBy'] ?? UserOrder::NAME_ASC->value);

        if ($orderEnum) {
            [$column, $direction] = $orderEnum->config();
            $query->orderBy($column, $direction);
        }

        return $query->get()
            ->filter(function($user){

                $filterPsychosocial = !empty($this->filters['has_answered_psychosocial_campaign']);
                $filterOrganizational = !empty($this->filters['has_answered_organizational_campaign']);

                if (!$filterPsychosocial && !$filterOrganizational) {
                    return true;
                }
                
                $answeredPsychosocial = $this->latestPsychosocialCampaign ? $user->hasAnsweredCampaign($this->latestPsychosocialCampaign->id) : false;
                $answeredOrganizational = $this->latestOrganizationalCampaign ? $user->hasAnsweredCampaign($this->latestOrganizationalCampaign->id) : false;

                if ($filterPsychosocial && !$filterOrganizational) {
                    return $answeredPsychosocial;
                }

                if ($filterOrganizational && !$filterPsychosocial) {
                    return $answeredOrganizational;
                }

                return $answeredPsychosocial && $answeredOrganizational;
            })
            ->map(function($user){
                $user->hasAnsweredPsychosocial = $this->latestPsychosocialCampaign ? $user->hasAnsweredCampaign($this->latestPsychosocialCampaign->id) : false;
                $user->hasAnsweredOrganizational = $this->latestOrganizationalCampaign ? $user->hasAnsweredCampaign($this->latestOrganizationalCampaign->id) : false;
                return $user;
            });
    }
}
