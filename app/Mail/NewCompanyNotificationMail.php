<?php

namespace App\Mail;

use App\Enums\Subscription\PaymentType;
use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewCompanyNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Company $company,
        public ?int $employeesCount = null,
        public ?PaymentType $paymentType = null,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nova empresa cadastrada'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new-company-notification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
