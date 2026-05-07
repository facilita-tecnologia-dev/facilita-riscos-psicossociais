<?php

namespace App\Livewire\Cms\Private\Psychosocial\Company;

use App\Enums\Campaign\MetodologyType;
use App\Models\Company;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompanyShowComponent extends Component
{
    use WithFileUploads;

    public Company $company;
    public string $psychosocialMetodology;

    public array $psychosocialMetodologies;
    
    public $helper_video;

    #[Validate('mimes:mp4,mov,avi,wmv,mkv|max:40960')]
    public $new_helper_video;

    public Collection $campaigns;

    public function render()
    {
        return view('livewire.cms.private.psychosocial.company.company-show-component');
    }

    public function mount(Company $company)
    {
        $this->company = $company;

        $this->campaigns = collect();

        $this->psychosocialMetodology = $company->psychosocial_collection_type;
        $this->psychosocialMetodologies = [
            ['label' => MetodologyType::HSE->label(), 'value' => MetodologyType::HSE->value],
            ['label' => MetodologyType::PROART->label(), 'value' => MetodologyType::PROART->value],
        ];

        $this->campaigns = $company->campaigns()->get()->sortByDesc('start_date');
    }

    #[On('company:update')]
    public function updateCompany(Company $company)
    {
        $this->company = $company;
    }

    public function updateHelperVideo()
    {
        $this->validate([
            'new_helper_video' => ['required', 'mimes:mp4,mov,avi,wmv,mkv', 'max:40960'],
        ]);

        /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
        $s3 = Storage::disk('s3');
        $path = $s3->putFileAs(
            env('AWS_TEST_HELPER_VIDEO_PATH'),
            $this->new_helper_video,
            uniqid() . '.' . $this->new_helper_video->getClientOriginalExtension()
        );

        $this->company->update(['test_helper_video' => $path]);

        $this->helper_video = $s3->temporaryUrl($path, now()->addMinutes(5));

        $this->dispatch('alert:success', 'Vídeo de contextualização atualizado!');
    }

    public function openHelperVideoModal()
    {
        $this->dispatch('open-helper-video-modal');
        $this->loadHelperVideo();
    }

    public function closeHelperVideoModal()
    {
        $this->helper_video = null;
        $this->dispatch('close-helper-video-modal');
    }

    public function loadHelperVideo()
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
        $s3 = Storage::disk('s3');

        if($this->company->test_helper_video){
            $this->helper_video = $s3->temporaryUrl($this->company->test_helper_video, now()->addMinutes(5));
        }
    }

    public function deleteHelperVideo()
    {
        Storage::disk('s3')->delete($this->company->test_helper_video);
        $this->company->update(['test_helper_video' => null]);
        $this->helper_video = null;

        $this->dispatch('alert:success', 'Vídeo de contextualização removido!');
    }
}
