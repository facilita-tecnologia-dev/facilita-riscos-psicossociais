<?php

namespace App\Livewire\Subscription;

use App\Models\Payment;
use Livewire\Component;

class PaymentComponent extends Component
{
    public Payment $payment;

    public function render()
    {
        return view('livewire.subscription.payment-component');
    }

    public function mount(Payment $payment): void
    {
        $this->payment = $payment;
    }

    public function pay(): void
    {
        if (! $this->payment->canBePaid()) return;

        $this->dispatch('openSubscriptionPaymentModal', ['payment_id' => $this->payment->id]);
    }
}
