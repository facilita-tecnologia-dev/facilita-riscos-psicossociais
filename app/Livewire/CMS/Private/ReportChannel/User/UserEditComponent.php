<?php

namespace App\Livewire\CMS\Private\ReportChannel\User;

use App\Enums\ReportChannel\ReportChannelUserTypes;
use App\Services\ReportChannelService;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserEditComponent extends Component
{
    use WithFileUploads;

    public array $user;    

    #[Validate('image|max:5120')] // 1MB Max
    public $profile_photo;

    public ?string $full_name = null;
    public ?string $cpf = null;
    public ?string $email = null;
    public ?string $type = null;

    public function render()
    {
        return view('livewire.cms.private.report-channel.user.user-edit-component');
    }

     public function mount(array $user)
    {
        $this->user = $user;

        /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
        $s3 = Storage::disk('s3');
        $this->profile_photo = $user['profile_photo'] ? $s3->temporaryUrl($user['profile_photo'], now()->addMinutes(5)) : null;
        

        $this->full_name = $user['full_name'];
        $this->cpf = $user['cpf'];
        $this->email = $user['email'];
        $this->type = ReportChannelUserTypes::from($user['type'])->label();
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

        $this->user = $response['data'];
        $this->profile_photo = $this->user['profile_photo'] ? $s3->temporaryUrl($this->user['profile_photo'], now()->addMinutes(5)) : null;

        $this->dispatch('alert:success', 'Usuário atualizado!');
    }
}
