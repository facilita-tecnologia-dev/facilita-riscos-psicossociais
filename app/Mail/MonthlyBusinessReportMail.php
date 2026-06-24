<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MonthlyBusinessReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public array $report
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Facilita Riscos Psicossociais - Relatório Mensal'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.monthly-business-report'
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
