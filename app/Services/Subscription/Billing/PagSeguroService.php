<?php

namespace App\Services\Subscription\Billing;

use App\Models\Company;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Support\Facades\Http;

class PagSeguroService
{
    public static function createCheckout(Company $company, Payment $payment): array {
        $response = Http::withToken(config('services.pagseguro.token'))
            ->acceptJson()
            ->post(
                self::baseUrl() . '/checkouts',
                [
                    'reference_id' => $payment->external_reference,
                    'expiration_date' => now()->addDays(3)->toIso8601String(),
                    'customer_modifiable' => true,
                    'items' => [
                        [
                            'name' => 'Assinatura - Facilita Riscos Psicossociais',
                            'quantity' => 1,
                            'unit_amount' => $payment->amount,
                        ],
                    ],
                    'payment_methods' => [
                        [
                            'type' => 'CREDIT_CARD',
                        ],
                        [
                            'type' => 'PIX',
                        ],
                        [
                            'type' => 'BOLETO',
                        ],
                    ],
                    'redirect_url' => config('app.url') . '/assinatura/sucesso',
                    'notification_urls' => [ config('app.url') . '/webhooks/pagseguro'],
                ]
            );

        if (! $response->successful()) {
            throw new \Exception($response->body());
        }

        $data = $response->json();

        $payLink = collect($data['links'])->firstWhere('rel', 'PAY')['href'];

        return [
            'gateway' => 'pagseguro',
            'checkout_url' => $payLink,
            'gateway_payment_id' => $data['id'],
            'gateway_status' => 'PENDING',
        ];
    }

    private static function baseUrl(): string
    {
        return config('services.pagseguro.environment') === 'production'
            ? config('services.pagseguro.production.base_url')
            : config('services.pagseguro.sandbox.base_url');
    }
}