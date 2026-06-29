<?php

namespace App\Livewire\Subscription;

use App\Enums\Subscription\PaymentStatus;
use App\Enums\Subscription\PaymentType;
use App\Enums\Subscription\SubscriptionStatus;
use App\Models\Subscription;
use App\Services\Auth\AuthenticationService;
use App\Services\Subscription\Billing\PagSeguroService;
use App\Services\Subscription\Billing\PaymentService;
use App\Services\Subscription\SubscriptionLifecycleService;
use App\Services\Subscription\SubscriptionPricingService;
use App\Services\Subscription\SubscriptionService;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Component;

class SignSectionComponent extends Component
{
    // Plan
    public int $employees = 50;
    public int $yearlyAmount = 0;
    public int $monthlyAmount = 0;
    public PaymentType $paymentType;
    public array $employeeTiers = [];

    // Steps: 'plan' | 'payment' | 'pix_waiting'
    public string $step = 'plan';

    // Payment method: 'credit_card' | 'pix'
    public string $paymentMethod = 'credit_card';

    // Card
    public ?string $cardError = null;

    // PIX
    public ?string $pixQrCodeText = null;
    public ?string $pixQrCodeImage = null;
    public ?string $pixExpiresAt = null;

    // PagBank JS SDK public key (safe to expose — RSA public key)
    public string $publicKey = '';

    public function render()
    {
        return view('livewire.subscription.sign-section-component');
    }

    public function mount()
    {
        $this->employeeTiers = SubscriptionPricingService::tiers();
        $this->paymentType   = PaymentType::MONTHLY;
        $this->calculate();
        $this->publicKey = PagSeguroService::getPublicKey();
        $this->restorePixState();
    }

    /* ---- Plan step ---- */

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

    public function goToPayment(): void
    {
        $validValues = array_column(SubscriptionPricingService::tiers(), 'value');

        $this->validate([
            'employees'   => ['required', 'integer', Rule::in($validValues)],
            'paymentType' => ['required', Rule::enum(PaymentType::class)],
        ]);

        $this->step = 'payment';
    }

    /* ---- Payment step ---- */

    public function setPaymentMethod(string $method): void
    {
        $this->paymentMethod = $method;
        $this->cardError     = null;
    }

    public function backToPlan(): void
    {
        $this->step      = 'plan';
        $this->cardError = null;
    }

    public function backToPayment(): void
    {
        $this->step           = 'payment';
        $this->pixQrCodeText  = null;
        $this->pixQrCodeImage = null;
        $this->pixExpiresAt   = null;
    }

    public function submitCard(string $encryptedCard): void
    {
        if (empty($encryptedCard)) {
            $this->cardError = 'Erro ao processar o cartão. Tente novamente.';
            return;
        }

        $this->cardError = null;

        try {
            $amount = $this->paymentType === PaymentType::MONTHLY ? $this->monthlyAmount : $this->yearlyAmount;

            $data    = SubscriptionService::createPendingSubscription(session('auth:company'), $this->employees, $amount, $this->paymentType);
            $payment = $data['payment'];

            $result = PagSeguroService::createCardCharge(session('auth:company'), $payment, $encryptedCard);

            $payment->update([
                'gateway'            => $result['gateway'],
                'gateway_payment_id' => $result['gateway_payment_id'],
                'gateway_status'     => $result['gateway_status'],
            ]);

            if ($result['status'] === 'PAID') {
                PaymentService::markAsPaidFromDirectCharge($payment, $result['payload']);
                SubscriptionLifecycleService::activate($payment->subscription);
                $this->redirectRoute('company.subscription.success');
                return;
            }

            $this->cardError = 'Pagamento recusado. Verifique os dados do cartão e tente novamente.';

        } catch (\Throwable $e) {
            Log::error('Erro no pagamento com cartão', ['error' => $e->getMessage()]);
            $this->cardError = 'Ocorreu um erro ao processar o pagamento. Tente novamente.';
        }
    }

    public function submitPix(): void
    {
        try {
            $amount = $this->paymentType === PaymentType::MONTHLY ? $this->monthlyAmount : $this->yearlyAmount;

            $data    = SubscriptionService::createPendingSubscription(session('auth:company'), $this->employees, $amount, $this->paymentType);
            $payment = $data['payment'];

            $result = PagSeguroService::createPixCharge(session('auth:company'), $payment);

            $payment->update([
                'gateway'            => $result['gateway'],
                'gateway_payment_id' => $result['gateway_payment_id'],
                'gateway_status'     => $result['gateway_status'],
                'metadata'           => array_merge($payment->metadata ?? [], [
                    'payment_method'   => 'pix',
                    'pix_qr_code_text' => $result['qr_code_text'],
                    'pix_qr_code_image'=> $result['qr_code_image'],
                    'pix_expires_at'   => $result['expires_at'],
                ]),
            ]);

            $this->pixQrCodeText  = $result['qr_code_text'];
            $this->pixQrCodeImage = $result['qr_code_image'];
            $this->pixExpiresAt   = $result['expires_at'];
            $this->step           = 'pix_waiting';

        } catch (\Throwable $e) {
            Log::error('Erro ao gerar PIX', ['error' => $e->getMessage()]);
            $this->dispatch('alert:danger', 'Ocorreu um erro ao gerar o PIX. Tente novamente.');
        }
    }

    /* ---- PIX waiting (polling) ---- */

    public function checkPixPayment(): void
    {
        if ($this->step !== 'pix_waiting') return;

        $company = session('auth:company')->fresh();

        if ($company->hasActiveSubscription()) {
            $this->redirectRoute('company.subscription.success');
        }
    }

    /* ---- Computed ---- */

    public function getFormattedYearlyProperty(): string
    {
        return number_format($this->yearlyAmount / 100, 2, ',', '.');
    }

    public function getFormattedMonthlyProperty(): string
    {
        return number_format($this->monthlyAmount / 100, 2, ',', '.');
    }

    public function getFormattedSelectedProperty(): string
    {
        $amount = $this->paymentType === PaymentType::MONTHLY ? $this->monthlyAmount : $this->yearlyAmount;
        return number_format($amount / 100, 2, ',', '.');
    }

    public function getEmployeeRangeProperty(): string
    {
        return SubscriptionPricingService::employeeRange($this->employees);
    }

    /* ---- Misc ---- */

    public function logout(): void
    {
        $redirectRoute = AuthenticationService::logout(request());
        $this->redirect($redirectRoute);
    }

    private function calculate(): void
    {
        $prices = SubscriptionPricingService::pricing($this->employees);

        $this->yearlyAmount  = $prices['yearly'];
        $this->monthlyAmount = $prices['monthly'];
    }

    private function restorePixState(): void
    {
        $subscription = Subscription::where('company_id', session('auth:company')->id)
            ->where('status', SubscriptionStatus::PENDING)
            ->latest()
            ->first();

        if (! $subscription) return;

        $payment = $subscription->payments()
            ->where('status', PaymentStatus::PENDING)
            ->latest()
            ->first();

        if (! $payment || ($payment->metadata['payment_method'] ?? null) !== 'pix') return;

        $this->pixQrCodeText  = $payment->metadata['pix_qr_code_text']  ?? null;
        $this->pixQrCodeImage = $payment->metadata['pix_qr_code_image'] ?? null;
        $this->pixExpiresAt   = $payment->metadata['pix_expires_at']    ?? null;

        if ($this->pixQrCodeText) {
            $this->step = 'pix_waiting';
        }
    }
}
