<?php

namespace App\Livewire\Cms\Private\Psychosocial\Company;

use App\Enums\Campaign\MetodologyType;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
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

    public ?string $registerName = null;
    public ?string $cnpj = null;
    public ?string $email = null;
    public ?string $psychosocialMetodology = MetodologyType::HSE->value;
    public ?string $password = null;
    public ?string $passwordConfirmation = null;

    public array $psychosocialMetodologies;

    public function render()
    {
        return view('livewire.cms.private.psychosocial.company.company-create-component');
    }

    public function mount()
    {
        $this->psychosocialMetodologies = [
            ['label' => MetodologyType::HSE->label(), 'value' => MetodologyType::HSE->value],
            ['label' => MetodologyType::PROART->label(), 'value' => MetodologyType::PROART->value],
        ];
    }

    public function submit()
    {
        $this->validate([
            'logo' => ['nullable', Rule::when($this->logo instanceof TemporaryUploadedFile,['image', 'max:5120'])],
            'registerName' => ['required', 'string', 'max:255'],
            'cnpj' => ['required', 'max:18', 'cnpj'],
            'email' => ['required', 'email', 'max:100'],
            'psychosocialMetodology' => ['required', new Enum(MetodologyType::class)],
            'password' => ['required', 'string', 'max:100', Password::defaults()],
            'passwordConfirmation' => ['required', 'string', 'same:password', 'max:100'],
        ]);

        if($this->logo){
            /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
            $s3 = Storage::disk('s3');
            $path = $s3->putFileAs(
                env('AWS_COMPANY_LOGO_PATH'),
                $this->logo,
                uniqid() . '.' . $this->logo->getClientOriginalExtension()
            );
        }

        $company = Company::create([
            'logo' => $this->logo ? $path : null,
            'name' => $this->registerName,
            'email' => $this->email,
            'cnpj' => $this->cnpj,
            'psychosocial_collection_type' => $this->psychosocialMetodology,
            'password' => $this->password,
        ]);

        $this->logo = $s3->temporaryUrl($path, now()->addMinutes(5));

        $this->dispatch('alert:success', 'Empresa cadastrada!');

        return redirect()->to(route('cms.psychosocial.company.show', $company));
    }
}
