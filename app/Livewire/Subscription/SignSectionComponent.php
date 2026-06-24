<?php

namespace App\Livewire\Subscription;

use App\Enums\Subscription\PaymentType;
use App\Services\Auth\AuthenticationService;
use App\Services\Subscription\Billing\PagSeguroService;
use App\Services\Subscription\SubscriptionPricingService;
use App\Services\Subscription\SubscriptionService;
use Illuminate\Validation\Rule;
use Livewire\Component;

class SignSectionComponent extends Component
{
    public int $employees = 50;

    public int $yearlyAmount = 0;
    public int $monthlyAmount = 0;

    public PaymentType $paymentType; // monthly | yearly

    public function render()
    {
        return view('livewire.subscription.sign-section-component');
    }

    public function mount()
    {
        $this->paymentType = PaymentType::MONTHLY;
        $this->calculate();
    }

    public function updatedEmployees()
    {
        $this->calculate();
    }

    public function setPaymentType(string $type)
    {
        $this->paymentType = PaymentType::from($type);
    }
    
    private function calculate()
    {
        $prices = SubscriptionPricingService::pricing($this->employees);

        $this->yearlyAmount = $prices['yearly'];
        $this->monthlyAmount = $prices['monthly'];
    }

    public function getFormattedYearlyProperty(): string
    {
        return number_format($this->yearlyAmount / 100, 2, ',', '.');
    }

    public function getFormattedMonthlyProperty(): string
    {
        return number_format($this->monthlyAmount / 100, 2, ',', '.');
    }

    public function getEmployeeRangeProperty(): string
    {
        return SubscriptionPricingService::employeeRange($this->employees);
    }

    public function submit()
    {
        $this->validate([
            'employees' => ['required', 'integer', 'min:1'],
            'paymentType' => ['required', Rule::enum(PaymentType::class)],
        ]);

        $amount = $this->paymentType->value === 'monthly' ? $this->monthlyAmount : $this->yearlyAmount;

        $data = SubscriptionService::createPendingSubscription(session('auth:company'), $this->employees, $amount, $this->paymentType);

        $payment = $data['payment'];

        $checkout = PagSeguroService::createCheckout(session('auth:company'), $payment);

        $payment->update([
            'gateway' => $checkout['gateway'],
            'gateway_payment_id' => $checkout['gateway_payment_id'],
            'gateway_status' => $checkout['gateway_status'],
            'checkout_url' => $checkout['checkout_url'],
        ]);

        return redirect()->away($checkout['checkout_url']);
    }

    public function logout()
    {
        $redirectRoute = AuthenticationService::logout(request());
        return redirect()->to($redirectRoute);
    }
}
