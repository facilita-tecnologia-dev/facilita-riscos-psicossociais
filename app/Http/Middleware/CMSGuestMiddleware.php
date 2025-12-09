<?php

namespace App\Http\Middleware;

use App\Services\Auth\AuthenticationService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CMSGuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('cms')->check()) {
            return redirect()->to(AuthenticationService::redirectLoginRoute('cms'));
        }

        return $next($request);
    }
}
