<?php

namespace App\Livewire\Site;

use Livewire\Attributes\On;
use Livewire\Component;

class HeroSectionVideosComponent extends Component
{
    public bool $showModal = false;
    public ?string $videoUrl = null;

    public function render()
    {
        return view('livewire.site.hero-section-videos-component');
    }

    #[On('openHeroVideoModal')]
    public function openModal(string $video): void
    {
        $this->videoUrl = $video;
        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->videoUrl = null;
    }

}
