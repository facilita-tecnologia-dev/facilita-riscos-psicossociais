<?php

namespace App\Livewire\Private\Home;

use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class CompanyHomeUploadLogoComponent extends Component
{
    use WithFileUploads;

    #[Validate('image|max:5120')] // 5MB Max
    public $logo;


    public function render()
    {
        return view('livewire.private.home.company-home-upload-logo-component');
    }

    public function nextStep()
    {
        $this->dispatch('step-by-step:next', 'logo');
    }

    public function submit()
    {
        $this->validate([
            'logo' => ['required', Rule::when($this->logo instanceof TemporaryUploadedFile,['image', 'max:5120'])],
        ]);

        try {
            /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
            $s3 = Storage::disk('s3');
            $path = $s3->putFileAs(
                env('AWS_COMPANY_LOGO_PATH'),
                $this->logo,
                uniqid() . '.' . $this->logo->getClientOriginalExtension()
            );
    
            session('auth:company')->update(['logo' => $path]);
    
            $this->dispatch('alert:success', 'Logomarca atualizada!');
            $this->nextStep();
        } catch (\Throwable $th) {
            $this->dispatch('alert:danger', 'Erro ao atualizar a logomarca!');
        }
    }
}
