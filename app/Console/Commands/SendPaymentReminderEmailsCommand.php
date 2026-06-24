<?php

namespace App\Console\Commands;

use App\Services\Subscription\Billing\PaymentReminderService;
use Illuminate\Console\Command;

class SendPaymentReminderEmailsCommand extends Command
{
    protected $signature = 'subscriptions:send-reminders';
    protected $description = 'Send payment reminder emails';

    public function handle()
    {
        PaymentReminderService::send();

        $this->info('Payment reminders processed successfully.');

        return self::SUCCESS;
    }
}
