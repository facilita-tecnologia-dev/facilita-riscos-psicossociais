<?php

namespace App\Livewire\CMS\Private\ReportChannel\Company;

use App\Services\ReportChannelService;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CompanyEditComponent extends Component
{
    public array $company;

    #[Validate('image|max:5120')] // 1MB Max
    public $logo;

    public ?string $register_name = null;
    public ?string $trade_name = null;
    public ?string $cnpj = null;
    public ?string $email = null;
    public ?string $contact_phone = null;
    public ?string $site_url = null;

    public function render()
    {
        return view('livewire.cms.private.report-channel.company.company-edit-component');
    }

    public function mount(array $company)
    {
        $this->company = $company;

        $this->register_name = $company['register_name'];
        $this->trade_name = $company['trade_name'];
        $this->cnpj = $company['cnpj'];
        $this->email = $company['email'];
        $this->contact_phone = $company['contact_phone'];
        $this->site_url = $company['site_url'];
    }

    public function submit()
    {
        $formData = [
            'register_name' => $this->register_name,
            'trade_name' => $this->trade_name,
            'cnpj' => $this->cnpj,
            'email' => $this->email,
            'contact_phone' => $this->contact_phone,
            'site_url' => $this->site_url,
        ];

        $response = ReportChannelService::companyUpdate($this->company['id'], $formData);

        if ($response->status() === 422) {
            $errors = $response->json('errors', []);

            foreach ($errors as $field => $messages) {
                foreach ($messages as $message) {
                    $this->addError($field, $message);
                }
            }

            return;
        }

        $this->company = $response['data'];

        $this->dispatch('company:updated', $this->company);
        $this->dispatch('alert:success', 'Empresa atualizada!');
    }
}
