<?php

namespace App\Livewire\Subscription;

use App\Enums\Subscription\PaymentType;
use App\Models\Subscription;
use App\Services\Subscription\Billing\PaymentService;
use App\Services\Subscription\SubscriptionLifecycleService;
use App\Services\Subscription\SubscriptionPricingService;
use Illuminate\Validation\Rule;
use Livewire\Component;

class SignEditComponent extends Component
{
    public Subscription $subscription;

    public int $employees;
    public int $yearlyAmount  = 0;
    public int $monthlyAmount = 0;
    public PaymentType $paymentType;
    public array $employeeTiers = [];

    public function render()
    {
        return view('livewire.subscription.sign-edit-component');
    }

    public function mount(Subscription $subscription): void
    {
        $this->subscription  = $subscription;
        $this->employeeTiers = SubscriptionPricingService::tiers();
        $this->employees     = $subscription->employees_count;
        $this->paymentType   = $subscription->type;
        $this->calculate();
    }

    public function setEmployees(int $value): void
    {
        $this->employees = $value;
        $this->calculate();
    }

    public function setPaymentType(string $type): void
    {
        $this->paymentType = PaymentType::from($type);
        $this->calculate();
    }

    public function submit(): void
    {
        $validValues = array_column(SubscriptionPricingService::tiers(), 'value');

        $this->validate([
            'employees'   => ['required', 'integer', Rule::in($validValues)],
            'paymentType' => ['required', Rule::enum(PaymentType::class)],
        ]);

        $employeesChanged        = $this->subscription->employees_count !== $this->employees;
        $typeChanged             = $this->subscription->type !== $this->paymentType;
        $cancelScheduledTypeChange = $this->subscription->scheduled_type && $this->subscription->type === $this->paymentType;

        if ($cancelScheduledTypeChange) {
            SubscriptionLifecycleService::cancelScheduledTypeChange($this->subscription);
            $this->dispatch('alert:success', 'A alteração da forma de cobrança foi cancelada.');
            return;
        }

        if (! $employeesChanged && ! $typeChanged) {
            $this->dispatch('alert:success', 'Nenhuma alteração foi realizada.');
            return;
        }

        if ($employeesChanged && $typeChanged) {
            $this->dispatch('alert:error', 'Altere a faixa de funcionários e a forma de cobrança separadamente.');
            return;
        }

        if ($typeChanged) {
            SubscriptionLifecycleService::scheduleTypeChange($this->subscription, $this->paymentType);
            $this->dispatch('alert:success', 'A alteração da forma de cobrança foi agendada para a próxima renovação.');
            return;
        }

        $amount  = $this->subscription->type === PaymentType::MONTHLY ? $this->monthlyAmount : $this->yearlyAmount;
        $payment = PaymentService::createPlanChangePayment($this->subscription, $amount, $this->employees, $this->subscription->type);

        $this->dispatch('close-sign-edit-modal');
        $this->dispatch('openSubscriptionPaymentModal', ['payment_id' => $payment->id]);
    }

    public function openSignEditModal(): void
    {
        $this->dispatch('open-sign-edit-modal');
    }

    public function closeSignEditModal(): void
    {
        $this->dispatch('close-sign-edit-modal');
    }

    private function calculate(): void
    {
        $prices = SubscriptionPricingService::pricing($this->employees);

        $this->yearlyAmount  = $prices['yearly'];
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
}
