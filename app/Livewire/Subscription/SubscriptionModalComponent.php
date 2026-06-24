<?php

namespace App\Livewire\Subscription;

use Livewire\Component;

class SubscriptionModalComponent extends Component
{
    public bool $open = false;

    public ?string $reason = null;

    protected $listeners = [
        'openSubscriptionModal' => 'open',
    ];

    public function render()
    {
        return view('livewire.subscription.subscription-modal-component');
    }

    public function open(array $data): void
    {
        $this->open = true;
        $this->reason = $data['reason'] ?? null;
    }

    public function close(): void
    {
        $this->open = false;
    }
}
