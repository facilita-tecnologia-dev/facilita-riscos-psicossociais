<?php

namespace App\Livewire\Subscription;

use App\Models\Company;
use App\Models\Subscription;
use App\Services\Subscription\SubscriptionLifecycleService;
use Livewire\Component;

class SignConfigComponent extends Component
{
    public Subscription $subscription;

    public function render()
    {
        return view('livewire.subscription.sign-config-component');
    }

    public function mount()
    {
        $this->subscription = Subscription::query()->where('company_id', session('auth:company')->id)->latest()->first();
    }

    public function cancel(): void
    {
        if (! $this->subscription->canBeCanceled()) return;

        SubscriptionLifecycleService::scheduleCancelation($this->subscription);

        $this->subscription->update([
            'scheduled_cancel_at' => now()->subMinute(),
        ]);

        $this->subscription->refresh();

        $this->dispatch('alert:success', 'Assinatura será cancelada ao final do período.');
    }

    public function reactivate(): void
    {
        if (! $this->subscription->canBeReactivated()) return;

        SubscriptionLifecycleService::reactivate($this->subscription);

        $this->subscription->refresh();

        $this->dispatch('alert:success', 'Assinatura reativada com sucesso.');
    }
}
