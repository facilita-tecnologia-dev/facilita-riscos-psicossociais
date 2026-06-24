<?php

namespace App\Observers;

use App\Models\Payment;
use Illuminate\Support\Str;

class PaymentObserver
{
    public function created(Payment $payment): void
    {
        $payment->invoice_number = 'INV-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6));
    }
}
