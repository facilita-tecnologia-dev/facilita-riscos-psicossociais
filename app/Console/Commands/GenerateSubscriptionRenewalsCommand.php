<?php

namespace App\Console\Commands;

use App\Enums\Subscription\SubscriptionStatus;
use App\Models\Subscription;
use App\Services\Subscription\SubscriptionRenewalService;
use Illuminate\Console\Command;

class GenerateSubscriptionRenewalsCommand extends Command
{
    protected $signature = 'subscriptions:generate-renewals';
    protected $description = 'Generate renewal payments for active subscriptions';

    public function handle()
    {
        $subscriptions = Subscription::query()
            ->where('status', SubscriptionStatus::ACTIVE)
            ->where('cancel_at_period_end', false)
            ->whereNotNull('current_period_end')
            ->where('current_period_end', '<=', now()->addDays(7))
            ->get();

        $generated = 0;
        $errors = 0;

        foreach ($subscriptions as $subscription) {
            try {
                $result = SubscriptionRenewalService::generateRenewal($subscription);

                if ($result['created']) {
                    $generated++;

                    $this->info("Renewal generated for subscription #{$subscription->id}");
                }
            } catch (\Throwable $exception) {
                $errors++;

                report($exception);
                $this->error("Failed to generate renewal for subscription #{$subscription->id}: {$exception->getMessage()}");
            }
        }

        $this->newLine();

        $this->info("Generated: {$generated}");
        $this->info("Errors: {$errors}");

        return self::SUCCESS;
    }
}
