<?php

namespace App\Mail;

use App\Enums\Subscription\PaymentEmailType;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Payment $payment,
        public PaymentEmailType $type
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->resolveSubject(),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.payment-notification',
            with: [
                'payment' => $this->payment,
                'type' => $this->type,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }

    private function resolveSubject(): string
    {
        return match ($this->type) {
            PaymentEmailType::CREATED => 'Nova cobrança disponível',

            PaymentEmailType::DUE_IN_3_DAYS => 'Sua cobrança vence em 3 dias',
            PaymentEmailType::DUE_IN_1_DAY => 'Sua cobrança vence em 1 dia',
            PaymentEmailType::DUE_TODAY => 'Sua cobrança vence hoje',

            PaymentEmailType::OVERDUE_3_DAYS => 'Sua cobrança está em atraso',
            PaymentEmailType::OVERDUE_7_DAYS => 'Sua assinatura poderá ser bloqueada',
            PaymentEmailType::OVERDUE_15_DAYS => 'Sua assinatura será cancelada',
        };
    }
}
