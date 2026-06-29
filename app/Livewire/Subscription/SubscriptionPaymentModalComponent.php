<?php

namespace App\Livewire\Subscription;

use App\Enums\Subscription\PaymentKind;
use App\Enums\Subscription\PaymentStatus;
use App\Models\Payment;
use App\Services\Subscription\Billing\PagSeguroService;
use App\Services\Subscription\Billing\PaymentService;
use App\Services\Subscription\SubscriptionLifecycleService;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SubscriptionPaymentModalComponent extends Component
{
    public bool $open = false;
    public ?Payment $payment = null;

    public string $step = 'payment'; // 'payment' | 'pix_waiting'
    public string $paymentMethod = 'credit_card';

    public string $publicKey    = '';
    public ?string $cardError   = null;

    public ?string $pixQrCodeText  = null;
    public ?string $pixQrCodeImage = null;
    public ?string $pixExpiresAt   = null;

    protected $listeners = [
        'openSubscriptionPaymentModal' => 'openWithPayment',
    ];

    public function render()
    {
        return view('livewire.subscription.subscription-payment-modal-component');
    }

    public function mount(): void
    {
        $this->publicKey = PagSeguroService::getPublicKey();
    }

    public function openWithPayment(array $data): void
    {
        $payment = Payment::find($data['payment_id'] ?? null);

        if (! $payment || ! $payment->canBePaid()) return;

        $this->payment      = $payment;
        $this->step         = 'payment';
        $this->paymentMethod = 'credit_card';
        $this->cardError    = null;
        $this->pixQrCodeText  = null;
        $this->pixQrCodeImage = null;
        $this->pixExpiresAt   = null;

        $this->restorePixState();

        $this->open = true;
    }

    public function close(): void
    {
        $this->open    = false;
        $this->payment = null;
    }

    public function setPaymentMethod(string $method): void
    {
        $this->paymentMethod = $method;
        $this->cardError     = null;
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
        if (empty($encryptedCard) || ! $this->payment) {
            $this->cardError = 'Erro ao processar o cartão. Tente novamente.';
            return;
        }

        $this->cardError = null;

        try {
            $result = PagSeguroService::createCardCharge(
                $this->payment->subscription->company,
                $this->payment,
                $encryptedCard
            );

            $this->payment->update([
                'gateway'            => $result['gateway'],
                'gateway_payment_id' => $result['gateway_payment_id'],
                'gateway_status'     => $result['gateway_status'],
            ]);

            if ($result['status'] === 'PAID') {
                PaymentService::markAsPaidFromDirectCharge($this->payment, $result['payload']);
                $this->handlePaymentPaid();
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
        if (! $this->payment) return;

        try {
            $result = PagSeguroService::createPixCharge(
                $this->payment->subscription->company,
                $this->payment
            );

            $this->payment->update([
                'gateway'            => $result['gateway'],
                'gateway_payment_id' => $result['gateway_payment_id'],
                'gateway_status'     => $result['gateway_status'],
                'metadata'           => array_merge($this->payment->metadata ?? [], [
                    'payment_method'    => 'pix',
                    'pix_qr_code_text'  => $result['qr_code_text'],
                    'pix_qr_code_image' => $result['qr_code_image'],
                    'pix_expires_at'    => $result['expires_at'],
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

    public function checkPixPayment(): void
    {
        if ($this->step !== 'pix_waiting' || ! $this->payment) return;

        $this->payment->refresh();

        if ($this->payment->status === PaymentStatus::PAID) {
            $this->handlePaymentPaid();
        }
    }

    private function handlePaymentPaid(): void
    {
        $subscription = $this->payment->subscription;

        match ($this->payment->kind) {
            PaymentKind::INITIAL     => SubscriptionLifecycleService::activate($subscription),
            PaymentKind::RENEWAL     => SubscriptionLifecycleService::renew($subscription),
            PaymentKind::PLAN_CHANGE => SubscriptionLifecycleService::changePlan(
                $subscription,
                $this->payment->metadata['employees_count'],
                $this->payment->metadata['amount']
            ),
        };

        if ($this->payment->kind === PaymentKind::INITIAL) {
            $this->redirectRoute('company.subscription.success');
            return;
        }

        $this->redirect(route('company.show', ['company' => $subscription->company]));
    }

    private function restorePixState(): void
    {
        if (! $this->payment || $this->payment->status !== PaymentStatus::PENDING) return;

        $metadata = $this->payment->metadata ?? [];
        if (($metadata['payment_method'] ?? null) !== 'pix') return;

        $this->pixQrCodeText  = $metadata['pix_qr_code_text']  ?? null;
        $this->pixQrCodeImage = $metadata['pix_qr_code_image'] ?? null;
        $this->pixExpiresAt   = $metadata['pix_expires_at']    ?? null;

        if ($this->pixQrCodeText) {
            $this->step = 'pix_waiting';
        }
    }
}
