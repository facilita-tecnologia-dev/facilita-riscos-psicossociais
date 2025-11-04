<?php

namespace App\Livewire\CMS\Private\ReportChannel\Company;

use App\Services\ReportChannelService;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class CompanyCreateComponent extends Component
{
    use WithFileUploads;

    #[Validate('image|max:5120')] // 1MB Max
    public $logo;

    public ?string $register_name = null;
    public ?string $trade_name = null;
    public ?string $cnpj = null;
    public ?string $contact_phone = null;
    public ?string $email = null;
    public ?string $site_url = null;
    public ?string $password = null;
    public ?string $password_confirmation = null;

    public function render()
    {
        return view('livewire.cms.private.report-channel.company.company-create-component');
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
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ];

        $response = ReportChannelService::companyCreate($formData);

        if ($response->status() === 422) {
            $errors = $response->json('errors', []);

            foreach ($errors as $field => $messages) {
                foreach ($messages as $message) {
                    $this->addError($field, $message);
                }
            }

            return;
        }

        // dd($response->json());

        // $logoPath = $this->logo instanceof TemporaryUploadedFile ? $this->logo->store('images', 'public') : $this->logo;

        $this->dispatch('alert:success', 'Empresa cadastrada!');

        // return redirect()->to(route('cms.report-channel.company.show', $company));
        return redirect()->to(route('cms.report-channel.company.index'));
    }
}
