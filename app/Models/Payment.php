<?php

namespace App\Models;

use App\Enums\Subscription\PaymentKind;
use App\Enums\Subscription\PaymentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $table = 'payments';

    protected function casts(): array
    {
        return [
            'due_date' => 'datetime',
            'paid_at' => 'datetime',
            'payload' => 'array',
            'kind' => PaymentKind::class,
            'status' => PaymentStatus::class,
            'metadata' => 'array',
        ];
    }


    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function hasReceipt(): bool
    {
        return ! empty($this->gateway_receipt_url);
    }

    public function canBePaid(): bool
    {
        return in_array($this->status, [PaymentStatus::PENDING, PaymentStatus::FAILED, PaymentStatus::OVERDUE]);
    }
}
