<?php

namespace App\Livewire\CMS\Private\ReportChannel\Company;

use App\Services\ReportChannel\ReportChannelService;
use Livewire\Component;

class CompanyCommitteeUserComponent extends Component
{
    public array $company;
    public array $user;

    public function render()
    {
        return view('livewire.cms.private.report-channel.company.company-committee-user-component');
    }

    public function mount(array $company, array $user)
    {
        $this->company = $company;
        $this->user = $user;
    }

    public function detachUser()
    {
        $response = ReportChannelService::companyCommitteeDetach($this->company['id'], $this->user['id']);
        
        if($response->status() === 200){
            $this->dispatch('committee:detached', $this->user['id']);
            $this->dispatch('alert:success', "Usuário desvinculado com sucesso!");
        } else {
            $this->dispatch('alert:danger', "Erro ao desvincular!");
        }
    }
}
