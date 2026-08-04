<?php

namespace App\Services\Subscription\Billing;

use App\Models\Company;
use App\Models\Payment;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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

    public static function getPublicKey(): string
    {
        return Cache::remember('pagseguro.public_key', 86400, function () {
            $response = Http::withToken(config('services.pagseguro.token'))
                ->acceptJson()
                ->get(self::baseUrl() . '/public-keys/card');

            if (! $response->successful()) {
                Log::error('PagSeguro public key error', [
                    'status' => $response->status(),
                    'headers' => $response->headers(),
                    'body' => $response->body(),
                ]);

                throw new \Exception('PagSeguro public key error: status ' . $response->status() . ' - ' . $response->body());
            }

            return $response->json('public_key');
        });
    }

    public static function createCardCharge(Company $company, Payment $payment, string $encryptedCard): array
    {
        $response = Http::withToken(config('services.pagseguro.token'))
            ->acceptJson()
            ->post(self::baseUrl() . '/charges', [
                'reference_id' => $payment->external_reference,
                'description' => 'Assinatura - Facilita Riscos Psicossociais',
                'amount' => ['value' => $payment->amount, 'currency' => 'BRL'],
                'payment_method' => [
                    'type' => 'CREDIT_CARD',
                    'installments' => 1,
                    'capture' => true,
                    'card' => ['encrypted' => $encryptedCard, 'store' => false],
                ],
                'notification_urls' => [config('app.url') . '/webhooks/pagseguro'],
            ]);

        if (! $response->successful()) {
            throw new \Exception('PagSeguro card charge error: ' . $response->body());
        }

        $data = $response->json();

        return [
            'gateway'            => 'pagseguro',
            'gateway_payment_id' => $data['id'],
            'gateway_status'     => $data['status'],
            'status'             => $data['status'],
            'payload'            => $data,
        ];
    }

    public static function createPixCharge(Company $company, Payment $payment): array
    {
        $expiresAt = now()->addHours(24);

        $response = Http::withToken(config('services.pagseguro.token'))
            ->acceptJson()
            ->post(self::baseUrl() . '/orders', [
                'reference_id'     => $payment->external_reference,
                'customer'         => [
                    'name'    => $company->name,
                    'email'   => $company->email,
                    // 'tax_id'  => preg_replace('/\D/', '', $company->cnpj), // fallback: CNPJ numérico (pré CNPJ alfanumérico)
                    'tax_id'  => preg_replace('/[.\/\-]/', '', strtoupper($company->cnpj)),
                ],
                'items'            => [[
                    'reference_id' => $payment->external_reference,
                    'name'         => 'Assinatura - Facilita Riscos Psicossociais',
                    'quantity'     => 1,
                    'unit_amount'  => $payment->amount,
                ]],
                'qr_codes'         => [[
                    'amount'          => ['value' => $payment->amount],
                    'expiration_date' => $expiresAt->toIso8601String(),
                ]],
                'notification_urls'=> [config('app.url') . '/webhooks/pagseguro'],
            ]);

        if (! $response->successful()) {
            throw new \Exception('PagSeguro PIX error: ' . $response->body());
        }

        $data   = $response->json();
        $qrCode = $data['qr_codes'][0] ?? [];

        return [
            'gateway'            => 'pagseguro',
            'gateway_payment_id' => $data['id'],
            'gateway_status'     => $data['status'] ?? 'WAITING',
            'qr_code_text'       => $qrCode['text'] ?? null,
            'qr_code_image'      => collect($qrCode['links'] ?? [])->firstWhere('media', 'image/png')['href'] ?? null,
            'expires_at'         => $qrCode['expiration_date'] ?? $expiresAt->toIso8601String(),
        ];
    }

    public static function sdkUrl(): string
    {
        return 'https://assets.pagseguro.com.br/checkout-sdk-js/rc/dist/browser/pagseguro.min.js';
    }

    private static function baseUrl(): string
    {
        return config('services.pagseguro.environment') === 'production'
            ? config('services.pagseguro.production.base_url')
            : config('services.pagseguro.sandbox.base_url');
    }
}