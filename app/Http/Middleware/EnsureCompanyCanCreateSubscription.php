<?php

namespace App\Http\Middleware;

use App\Enums\Subscription\SubscriptionStatus;
use App\Models\Company;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCompanyCanCreateSubscription
{
    public function handle(Request $request, Closure $next): Response
    {
        $company = Company::find(session('auth:company')?->id);

        if (! $company) {
            return $next($request);
        }

        // Empresa administrada externamente
        if ($company->usesExternalBilling()) {
            return redirect()->route('home.company');
        }

        // Já possui assinatura ativa
        if ($company->subscription_status === SubscriptionStatus::ACTIVE) {
            return redirect()->route('company.show', session('auth:company'));
        }

        return $next($request);
    }
}
