<?php

namespace App\Models;

use App\Enums\Subscription\PaymentStatus;
use App\Enums\Subscription\PaymentType;
use App\Enums\Subscription\SubscriptionStatus;
use App\Services\Subscription\SubscriptionPricingService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';

    protected function casts(): array
    {
        return [
            'type' => PaymentType::class,
            'scheduled_type' => PaymentType::class,
            'status' => SubscriptionStatus::class,
            'started_at' => 'datetime',
            'current_period_start' => 'datetime',
            'current_period_end' => 'datetime',
            'next_billing_at' => 'datetime',
            'scheduled_cancel_at' => 'datetime',
            'canceled_at' => 'datetime',
            'ended_at' => 'datetime',
            'cancel_at_period_end' => 'boolean',
        ];
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(SubscriptionEvent::class);
    }

    public function isTrial(): bool
    {
        return $this->status === SubscriptionStatus::TRIALING;
    }

    public function isActive(): bool
    {
        return $this->status === SubscriptionStatus::ACTIVE;
    }

    public function isPastDue(): bool
    {
        return $this->status === SubscriptionStatus::PAST_DUE;
    }

    public function isCanceled(): bool
    {
        return $this->status === SubscriptionStatus::CANCELED;
    }

    public function willCancel(): bool
    {
        return $this->cancel_at_period_end;
    }

    public function isPending(): bool
    {
        return $this->status === SubscriptionStatus::PENDING;
    }

    public function isWithinCurrentPeriod(): bool
    {
        if (! $this->current_period_end) return false;

        return now()->lessThanOrEqualTo($this->current_period_end);
    }

    public function shouldBeCanceled(): bool
    {
        return $this->cancel_at_period_end && $this->scheduled_cancel_at && now()->greaterThanOrEqualTo($this->scheduled_cancel_at);
    }

    public function canBeCanceled(): bool
    {
        return $this->status === SubscriptionStatus::ACTIVE
            && ! $this->cancel_at_period_end;
    }

    public function canBeReactivated(): bool
    {
        return $this->status === SubscriptionStatus::ACTIVE
            && $this->cancel_at_period_end;
    }

    public function isEnded(): bool
    {
        return $this->status === SubscriptionStatus::ENDED;
    }

    public function hasScheduledTypeChange(): bool
    {
        return $this->scheduled_type !== null;
    }

    public function employeesLimit(): int
    {
        return SubscriptionPricingService::maxEmployees($this->employees_count);
    }

    public function pendingPayment(): ?Payment
    {
        return $this->payments()
            ->whereIn('status', [PaymentStatus::PENDING, PaymentStatus::FAILED, PaymentStatus::OVERDUE])
            ->latest()
            ->first();
    }
}
