<?php

namespace App\Livewire\CMS\Private\Psychosocial\Company;

use App\Enums\BaseCollection;
use App\Models\Company;
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
    public ?string $psychosocialMetodology = BaseCollection::HSE->value;
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
            ['label' => BaseCollection::HSE->label(), 'value' => BaseCollection::HSE->value],
            ['label' => BaseCollection::PROART->label(), 'value' => BaseCollection::PROART->value],
        ];
    }

    public function submit()
    {
        $this->validate([
            'logo' => ['nullable', Rule::when($this->logo instanceof TemporaryUploadedFile,['image', 'max:5120'])],
            'registerName' => ['required', 'string', 'max:255'],
            'cnpj' => ['required', 'max:18', 'cnpj'],
            'email' => ['required', 'email', 'max:100'],
            'psychosocialMetodology' => ['required', new Enum(BaseCollection::class)],
            'password' => ['required', 'string', 'max:100', Password::defaults()],
            'passwordConfirmation' => ['required', 'string', 'same:password', 'max:100'],
        ]);

        $logoPath = $this->logo instanceof TemporaryUploadedFile ? $this->logo->store('images', 'public') : $this->logo;

        $company = Company::create([
            'logo' => $logoPath,
            'name' => $this->registerName,
            'email' => $this->email,
            'cnpj' => $this->cnpj,
            'psychosocial_collection_type' => $this->psychosocialMetodology,
            'password' => $this->password,
        ]);

        $this->dispatch('alert:success', 'Empresa cadastrada!');

        return redirect()->to(route('cms.psychosocial.company.show', $company));
    }
}
