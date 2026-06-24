<?php

namespace App\Livewire\Subscription;

use App\Enums\Subscription\PaymentType;
use App\Models\Subscription;
use App\Services\Subscription\Billing\PagSeguroService;
use App\Services\Subscription\Billing\PaymentService;
use App\Services\Subscription\SubscriptionLifecycleService;
use App\Services\Subscription\SubscriptionPricingService;
use Illuminate\Validation\Rule;
use Livewire\Component;

class SignEditComponent extends Component
{
    public Subscription $subscription;

    public int $employees;

    public int $yearlyAmount = 0;
    public int $monthlyAmount = 0;

    public PaymentType $paymentType;

    public function render()
    {
        return view('livewire.subscription.sign-edit-component');
    }

    public function mount(Subscription $subscription)
    {
        $this->subscription = $subscription;

        $this->employees = $subscription->employees_count;
        $this->paymentType = $subscription->type;

        $this->calculate();
    }

    public function updatedEmployees(): void
    {
        $this->calculate();
    }

    public function setPaymentType(string $type)
    {
        $this->paymentType = PaymentType::from($type);
    }

    private function calculate(): void
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

        $employeesChanged = $this->subscription->employees_count !== $this->employees;
        $typeChanged = $this->subscription->type !== $this->paymentType;
        $cancelScheduledTypeChange = $this->subscription->scheduled_type && $this->subscription->type === $this->paymentType;

        if ($cancelScheduledTypeChange) {
            SubscriptionLifecycleService::cancelScheduledTypeChange($this->subscription);
            $this->dispatch('alert:success', 'A alteração da forma de cobrança foi cancelada.');
            return;
        }

        if (!$employeesChanged && !$typeChanged) {
            $this->dispatch('alert:success', 'Nenhuma alteração foi realizada.');
            return;
        }

        if ($employeesChanged && $typeChanged) {
            $this->dispatch('alert:error', 'Altere a faixa de funcionários e a forma de cobrança separadamente.');
            return;
        }

        if ($typeChanged) {
            $this->handleBillingTypeChange($this->subscription);
            return;
        }

        if ($employeesChanged) {
            $this->handleEmployeeRangeChange($this->subscription);
            return;
        }
    }

    private function handleBillingTypeChange(Subscription $subscription): void {
        SubscriptionLifecycleService::scheduleTypeChange($subscription, $this->paymentType);
        $this->dispatch('alert:success', 'A alteração da forma de cobrança foi agendada para a próxima renovação.');
    }

    private function handleEmployeeRangeChange(Subscription $subscription): void {
        $amount = $this->paymentType === PaymentType::MONTHLY ? $this->monthlyAmount : $this->yearlyAmount;

        $payment = PaymentService::createPlanChangePayment($subscription, $amount, $this->employees, $subscription->type);
        $checkout = PagSeguroService::createCheckout(session('auth:company'), $payment);

        $payment->update([
            'gateway' => $checkout['gateway'],
            'gateway_payment_id' => $checkout['gateway_payment_id'],
            'gateway_status' => $checkout['gateway_status'],
            'checkout_url' => $checkout['checkout_url'],
        ]);

        redirect()->away($checkout['checkout_url']);
    }

    public function openSignEditModal()
    {
        $this->dispatch('open-sign-edit-modal');
    }
    
    public function closeSignEditModal()
    {
        $this->dispatch('close-sign-edit-modal');
    }
}
