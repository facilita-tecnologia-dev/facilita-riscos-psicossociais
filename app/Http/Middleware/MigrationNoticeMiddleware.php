<?php

namespace App\Http\Middleware;

use Carbon\CarbonImmutable;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Passagem para o Facilita RH (RP21): a empresa migrada não usa mais este sistema. Durante os dias de adaptação, toda
 * tela leva à página de passagem; depois deles, direto ao Facilita RH (empresa) ou ao Conecta (funcionário).
 * Ver config/migration_notice.php.
 */
class MigrationNoticeMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $companyId = session('auth:company')?->id;
        $migratedAt = $companyId !== null ? (config('migration_notice.companies')[$companyId] ?? null) : null;
        if ($migratedAt === null) {
            return $next($request);
        }

        $isCompany = session('auth:guard') === 'company';
        $target = $isCompany ? config('migration_notice.company_url') : config('migration_notice.user_url');
        $deadline = CarbonImmutable::parse($migratedAt)->startOfDay()->addDays(config('migration_notice.days'));
        $daysLeft = (int) ceil(now()->startOfDay()->diffInDays($deadline, false));

        if ($daysLeft <= 0) {
            return redirect()->away($target);
        }

        return response()->view('migration-notice', [
            'isCompany' => $isCompany,
            'target' => $target,
            'daysLeft' => $daysLeft,
            'deadline' => $deadline,
        ]);
    }
}
