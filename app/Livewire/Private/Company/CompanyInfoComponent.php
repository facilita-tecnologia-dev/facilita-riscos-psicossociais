<?php

namespace App\Livewire\Private\Company;

use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class CompanyInfoComponent extends Component
{
    public Company $company;
    public ?string $logo = null;

    public function render()
    {
        return view('livewire.private.company.company-info-component');
    }

    public function mount(Company $company)
    {
        $this->company = $company;

        /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
        $s3 = Storage::disk('s3');
        $this->logo = $this->company->logo ? $s3->temporaryUrl($this->company->logo, now()->addMinutes(5)) : null;
    }
}
