<?php

namespace App\Console\Commands;

use App\Enums\Subscription\PaymentStatus;
use App\Enums\Subscription\SubscriptionStatus;
use App\Models\Subscription;
use App\Services\Subscription\SubscriptionLifecycleService;
use Illuminate\Console\Command;

class CancelOverdueSubscriptionsCommand extends Command
{
    protected $signature = 'subscriptions:cancel-overdue';

    protected $description = 'Cancel overdue subscriptions after grace period';

    public function handle(): int
    {
        $subscriptions = Subscription::query()
            ->where('status', SubscriptionStatus::PAST_DUE)
            ->whereNotNull('past_due_at')
            ->where('past_due_at', '<=', now()->subDays(15))
            ->get();

        $canceled = 0;
        $errors = 0;

        foreach ($subscriptions as $subscription) {
            try {
                SubscriptionLifecycleService::finalizeCancellation($subscription);

                $canceled++;

                $this->info("Subscription #{$subscription->id} canceled.");
            } catch (\Throwable $exception) {
                $errors++;

                report($exception);

                $this->error("Failed to cancel subscription #{$subscription->id}: {$exception->getMessage()}");
            }
        }

        $this->newLine();

        $this->info("Canceled: {$canceled}");
        $this->info("Errors: {$errors}");

        return self::SUCCESS;
    }
}
