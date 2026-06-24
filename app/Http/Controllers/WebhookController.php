<?php

namespace App\Http\Controllers;

use App\Models\WebhookLog;
use App\Services\Subscription\Billing\BillingWebhookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController
{
    public function pagSeguro(Request $request, BillingWebhookService $service) {
        Log::info('PagSeguro Webhook', $request->all());
        
        WebhookLog::create([
            'gateway' => 'pagseguro',
            'payload' => $request->all(),
        ]);

        $service->handlePagSeguroWebhook($request->all());
        return response()->noContent();
    }
}
