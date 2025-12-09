<?php

namespace App\Livewire\CMS\Private\ReportChannel\User;

use App\Services\ReportChannel\ReportChannelService;
use Livewire\Component;

class UserCompaniesComponent extends Component
{
    public array $user;
    public array $companies;

    public ?string $company = null;
    public ?string $department = null;

    public array $companiesToAttach = [];
    public array $selectedCompanyDepartments = [];

    public function render()
    {
        return view('livewire.cms.private.report-channel.user.user-companies-component');
    }

    public function mount(array $user)
    {
        $this->user = $user;
        $this->companies = ReportChannelService::userCompanies($this->user['id']);

        $allCompanies = ReportChannelService::companies();
        $userCompanies = array_column($this->companies, 'id');

        $this->companiesToAttach = collect($allCompanies)
            ->reject(fn($company) => in_array($company['id'], $userCompanies))
            ->map(fn($company) => [
                'label' => $company['register_name'],
                'value' => $company['id'],
            ])
            ->values()
            ->toArray();
    }

    public function attach()
    {
        $formData = [
            'company' => $this->company,
            'department' => $this->department,
        ];
        
        $response = ReportChannelService::companyCommitteeAttach($this->company, $this->user['id'], $formData);

        if ($response->status() === 422) {
            $errors = $response->json('errors', []);

            foreach ($errors as $field => $messages) {
                foreach ($messages as $message) {
                    $this->addError($field, $message);
                }
            }

            return;
        }

        $this->companies[] = $response->json()['company'];
        $this->companiesToAttach = array_values(array_filter($this->companiesToAttach, fn($company) => $company['value'] != $response->json()['company']['id']));

        $this->dispatch('alert:success', 'Usuário vinculado!');
    }

    public function detach(string $companyID)
    {
        $response = ReportChannelService::companyCommitteeDetach($companyID, $this->user['id']);
        
        if($response->status() === 200){
            $this->companies = array_values(array_filter($this->companies, fn($company) => $company['id'] != $companyID));
            $this->companiesToAttach[] =  ['label' => $response->json()['company']['register_name'], 'value' => $response->json()['company']['id']];
            $this->dispatch('alert:success', "Usuário desvinculado com sucesso!");
        } else {
            $this->dispatch('alert:danger', "Erro ao desvincular!");
        }
    }

    public function updatedCompany()
    {
        if($this->company) {
            $this->selectedCompanyDepartments = array_map(fn ($department) => ['label' => $department['department'], 'value' => $department['id']], ReportChannelService::companyDepartments($this->company));
        }
    }
}
