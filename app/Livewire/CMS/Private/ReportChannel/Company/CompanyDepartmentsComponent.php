<?php

namespace App\Livewire\CMS\Private\ReportChannel\Company;

use App\Services\ReportChannelService;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CompanyDepartmentsComponent extends Component
{
    public array $company;
    public array $departments;
    public array $onlyTrashed;

    public bool $showTrashed = false;
    public ?string $new_department = null;

    public function render()
    {
        return view('livewire.cms.private.report-channel.company.company-departments-component');
    }

    public function mount(array $company)
    {
        $this->company = $company;
        $this->departments = ReportChannelService::companyDepartments($this->company['id']);
        $this->onlyTrashed = array_filter($this->departments, fn($d) => !is_null($d['deleted_at']));
    }

    public function createDepartment()
    {
        $formData = [
            'new_department' => $this->new_department,
        ];

        $response = ReportChannelService::companyDepartmentCreate($this->company['id'], $formData);

        if ($response->status() === 422) {
            $errors = $response->json('errors', []);

            foreach ($errors as $field => $messages) {
                foreach ($messages as $message) {
                    $this->addError($field, $message);
                }
            }

            return;
        }

        $this->departments[] = $response->json()['data'];

        $this->dispatch('alert:success', 'Setor criado!');

        $this->reset(['new_department']);
    }

    public function deleteDepartment(string $departmentID)
    {
        $response = ReportChannelService::companyDepartmentForceDelete($this->company['id'], $departmentID);

        if ($response->status() === 200) {
            $this->departments = array_values(array_filter($this->departments, fn($department) => $department['id'] != $departmentID));
            $this->dispatch('alert:success', 'Setor excluído!');

            return;
        }

        $this->dispatch('alert:danger', 'Erro na desativação do setor!');
    }

    public function softDeleteDepartment(string $departmentID)
    {
        $response = ReportChannelService::companyDepartmentSoftDelete($this->company['id'], $departmentID);

        if ($response->status() === 200) {
            $updatedDepartment = $response->json()['department'];

            $this->departments = array_map(function ($department) use ($updatedDepartment) {
                return $department['id'] === $updatedDepartment['id'] ? $updatedDepartment : $department;
            }, $this->departments);
            $this->onlyTrashed[] = $response->json()['department'];

            $this->dispatch('alert:success', 'Setor desativado!');

            return;
        }

        $this->dispatch('alert:danger', 'Erro na desativação do setor!');
    }

    public function restoreDepartment(string $departmentID)
    {
        $response = ReportChannelService::companyDepartmentRestore($this->company['id'], $departmentID);

        if ($response->status() === 200) {
            $updatedDepartment = $response->json()['department'];

            $this->departments = array_map(function ($department) use ($updatedDepartment) {
                return $department['id'] === $updatedDepartment['id'] ? $updatedDepartment : $department;
            }, $this->departments);

            $this->onlyTrashed = array_values(array_filter($this->onlyTrashed, fn($department) => $department['id'] != $updatedDepartment['id']));
            
            if(empty($this->onlyTrashed)) $this->showTrashed = false;

            $this->dispatch('alert:success', 'Setor reativado!');

            return;
        }

        $this->dispatch('alert:danger', 'Erro na reativação do setor!');
    }
}
