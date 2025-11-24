<?php

namespace App\Livewire\CMS\Private\ReportChannel\User;

use App\Enums\ReportChannel\ReportChannelUserTypes;
use App\Services\ReportChannelService;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserCreateComponent extends Component
{
    use WithFileUploads;

    #[Validate('image|max:5120')] // 1MB Max
    public $profile_photo;

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
        
        if(request()->filled('company')){
            $this->company = request()->input('company');
            $this->selectedCompanyDepartments = array_map(fn ($department) => ['label' => $department['department'], 'value' => $department['id']], ReportChannelService::companyDepartments($this->company));
        }
    }

    public function submit()
    {
        if($this->profile_photo){
            /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
            $s3 = Storage::disk('s3');
            $path = $s3->putFileAs(
                env('AWS_USER_PROFILE_PHOTO_PATH'),
                $this->profile_photo,
                uniqid() . '.' . $this->profile_photo->getClientOriginalExtension()
            );
        }

        $formData = [
            'profile_photo' => $this->profile_photo ? $path : null,
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

        $this->dispatch('alert:success', 'Usuário cadastrado!');
        
        return redirect()->to(route('cms.report-channel.user.show', $response->json()['data']['id']));
    }

    public function updatedCompany()
    {
        if($this->company) {
            $this->selectedCompanyDepartments = array_map(fn ($department) => ['label' => $department['department'], 'value' => $department['id']], ReportChannelService::companyDepartments($this->company));
        }
    }
}
