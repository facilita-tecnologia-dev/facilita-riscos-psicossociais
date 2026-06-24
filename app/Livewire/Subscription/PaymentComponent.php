<?php

namespace App\Livewire\Subscription;

use App\Models\Payment;
use App\Services\Subscription\Billing\PagSeguroService;
use Livewire\Component;

class PaymentComponent extends Component
{
    public Payment $payment;

    public function render()
    {
        return view('livewire.subscription.payment-component');
    }

    public function mount(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function pay()
    {
        if (! $this->payment->canBePaid()) return;

        if ($this->payment->checkout_url && $this->payment->created_at->greaterThan(now()->subDays(3))) {
            return redirect()->away($this->payment->checkout_url);
        }

        $checkout = PagSeguroService::createCheckout($this->payment->subscription->company, $this->payment);

        $this->payment->update([
            'gateway' => $checkout['gateway'],
            'gateway_payment_id' => $checkout['gateway_payment_id'],
            'gateway_status' => $checkout['gateway_status'],
            'checkout_url' => $checkout['checkout_url'],
        ]);

        return redirect()->away($checkout['checkout_url']);
    }
}
