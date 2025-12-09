<?php

namespace App\Http\Middleware;

use App\Services\Auth\AuthenticationService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GuestMiddleware
{
    protected $AuthenticationService;

    public function __construct(AuthenticationService $AuthenticationService)
    {
        $this->AuthenticationService = $AuthenticationService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        if (session('auth:user')) {
            $redirect = AuthenticationService::redirectLoginRoute(session('auth:guard'));

            return redirect()->to($redirect);
        }

        return $next($request);
    }
}
