<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanAccessOrganizationalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $company = session('auth:company');

        if(!$company) {return redirect()->back();}
        if(!$company->can_access_organizational){return redirect()->back();}

        return $next($request);
    }
}
