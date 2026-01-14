<?php

namespace App\Livewire\Cms\Private\ReportChannel\Company;

use App\Enums\ReportChannel\ReportChannelCompanySubscriptionTypes;
use App\Services\ReportChannel\ReportChannelService;
use Livewire\Component;

class CompanyAccessConfigComponent extends Component
{
    public array $company;
    
    public function render()
    {
        return view('livewire.cms.private.report-channel.company.company-access-config-component');
    }

    public function mount(array $company)
    {
        $this->company = $company;
    }

    public function turnAccessOn()
    {
        $response = ReportChannelService::companyAccessConfig($this->company['id'], ['subscription_type' => ReportChannelCompanySubscriptionTypes::SUBSCRIBED->value]);
        
        if($response->status() === 200){
            $this->company['subscription_type'] = ReportChannelCompanySubscriptionTypes::SUBSCRIBED->value;
            $this->dispatch('alert:success', "Acesso liberado com sucesso!");
        } else {
            $this->dispatch('alert:danger', "Erro ao liberar acesso!");
        }
    }

    public function turnAccessOff()
    {
        $response = ReportChannelService::companyAccessConfig($this->company['id'], ['subscription_type' => ReportChannelCompanySubscriptionTypes::FREE_TRIAL_EXPIRED->value]);
       
        if($response->status() === 200){
            $this->company['subscription_type'] = ReportChannelCompanySubscriptionTypes::FREE_TRIAL_EXPIRED->value;
            $this->dispatch('alert:success', "Acesso bloqueado com sucesso!");
            // $this->refresh();
        } else {
            $this->dispatch('alert:danger', "Erro ao bloquear acesso!");
        }
    }
}
