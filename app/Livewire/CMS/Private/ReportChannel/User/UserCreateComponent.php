<?php

namespace App\Livewire\CMS\Private\ReportChannel\User;

use App\Enums\ReportChannel\ReportChannelUserTypes;
use App\Services\ReportChannelService;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserCreateComponent extends Component
{
    use WithFileUploads;

    #[Validate('image|max:5120')] // 1MB Max
    public $logo;

    public ?string $full_name = null;
    public ?string $cpf = null;
    public ?string $email = null;
    public ?string $type = ReportChannelUserTypes::CONSULTANT->value;
    public ?string $password = null;
    public ?string $password_confirmation = null;
    public ?string $company = null;
    public ?string $department = null;

    public array $userTypes = [];
    public array $companies = [];
    public array $selectedCompanyDepartments = [];

    public function render()
    {
        return view('livewire.cms.private.report-channel.user.user-create-component');
    }

    public function mount()
    {
        $this->userTypes = array_map(fn ($userType) => ['label' => $userType->label(), 'value' => $userType], ReportChannelUserTypes::cases());
        $this->companies = array_merge([['label' => 'Nenhuma', 'value' => '']], array_map(fn ($company) => ['label' => $company['register_name'], 'value' => $company['id']], ReportChannelService::companies()));
    }

    public function submit()
    {
        $formData = [
            'full_name' => $this->full_name,
            'cpf' => $this->cpf,
            'email' => $this->email,
            'type' => $this->type,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'company' => $this->company,
            'department' => $this->department,
        ];

        $response = ReportChannelService::userCreate($formData);

        if ($response->status() === 422) {
            $errors = $response->json('errors', []);

            foreach ($errors as $field => $messages) {
                foreach ($messages as $message) {
                    $this->addError($field, $message);
                }
            }

            return;
        }

        // $logoPath = $this->logo instanceof TemporaryUploadedFile ? $this->logo->store('images', 'public') : $this->logo;

        $this->dispatch('alert:success', 'Usuário cadastrado!');

        // return redirect()->to(route('cms.report-channel.user.show', $user));
        return redirect()->to(route('cms.report-channel.user.index'));
    }

    public function updatedCompany()
    {
        if($this->company) {
            $this->selectedCompanyDepartments = array_map(fn ($department) => ['label' => $department['department'], 'value' => $department['id']], ReportChannelService::companyDepartments($this->company));
        }
    }
}
