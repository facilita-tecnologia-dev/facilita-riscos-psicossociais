<?php

namespace App\Livewire\CMS\Private\ReportChannel\User;

use App\Enums\ReportChannel\ReportChannelUserTypes;
use App\Services\ReportChannelService;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserEditComponent extends Component
{
    use WithFileUploads;

    public array $user;    

    #[Validate('image|max:5120')] // 1MB Max
    public $logo;

    public ?string $full_name = null;
    public ?string $cpf = null;
    public ?string $email = null;
    public ?string $type = null;
    // public ?string $type = ReportChannelUserTypes::CONSULTANT->value;
    // public ?string $password = null;
    // public ?string $password_confirmation = null;
    // public ?string $company = null;
    // public ?string $department = null;

    // public array $userTypes = [];
    // public array $companies = [];
    // public array $selectedCompanyDepartments = [];

    public function render()
    {
        return view('livewire.cms.private.report-channel.user.user-edit-component');
    }

     public function mount(array $user)
    {
        $this->user = $user;

        $this->full_name = $user['full_name'];
        $this->cpf = $user['cpf'];
        $this->email = $user['email'];
        $this->type = ReportChannelUserTypes::from($user['type'])->label();
    }

    public function submit()
    {
        $formData = [
            'full_name' => $this->full_name,
            'cpf' => $this->cpf,
            'email' => $this->email,
        ];

        $response = ReportChannelService::userUpdate($this->user['id'], $formData);

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

        $this->dispatch('alert:success', 'Usuário atualizado!');

        // return redirect()->to(route('cms.report-channel.user.show', $user));
        // return redirect()->to(route('cms.report-channel.user.index'));
    }
}
