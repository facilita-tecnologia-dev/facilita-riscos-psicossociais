<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Services\Subscription\SubscriptionLifecycleService;
use Illuminate\Console\Command;

class FinalizeScheduledCancellationsCommand extends Command
{
    protected $signature = 'subscriptions:finalize-cancellations';
    protected $description = 'Finalize subscriptions scheduled for cancellation';

    public function handle()
    {
        $subscriptions = Subscription::query()
            ->where('cancel_at_period_end', true)
            ->whereNotNull('scheduled_cancel_at')
            ->where('scheduled_cancel_at', '<=', now())
            ->get();

        $finalized = 0;
        $errors = 0;

        foreach ($subscriptions as $subscription) {
            try {
                SubscriptionLifecycleService::finalizeCancellation($subscription);

                $finalized++;

                $this->info("Subscription #{$subscription->id} finalized.");
            } catch (\Throwable $exception) {
                $errors++;

                report($exception);

                $this->error("Failed to finalize subscription #{$subscription->id}: {$exception->getMessage()}");
            }
        }

        $this->newLine();

        $this->info("Finalized: {$finalized}");
        $this->info("Errors: {$errors}");

        return self::SUCCESS;
    }
}
