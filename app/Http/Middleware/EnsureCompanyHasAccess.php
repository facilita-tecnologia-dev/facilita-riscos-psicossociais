<?php

namespace App\Http\Middleware;

use App\Models\Company;
use App\Services\Auth\AuthenticationService;
use App\Services\Subscription\CompanyAccessService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCompanyHasAccess
{
    public function __construct(private CompanyAccessService $companyAccessService) {}

    public function handle(Request $request, Closure $next): Response
    {
        $company = Company::find(session("auth:company")->id);

        if (! $company) return $next($request);

        if ($this->companyAccessService->mustBlock($company)) {
            return $this->blockedResponse($request, $company);
        }

        return $next($request);
    }

    private function blockedResponse(Request $request, Company $company): Response {
        $reason = $this->companyAccessService->getBlockingReason($company);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'type' => 'subscription_required',
                'code' => 'SUBSCRIPTION_REQUIRED',
                'reason' => $reason,
                'access' => [
                    'can_use_product' => false,
                    'can_manage_billing' => true,
                ],
            ], 403);
        }
        return redirect()->route('company.subscription.index');
    }
}
