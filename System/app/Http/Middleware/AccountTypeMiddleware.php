<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountTypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $accountType): Response
    {
        $authenticatedAccountType = session()->get('account_type');

        if (! $authenticatedAccountType || $authenticatedAccountType !== $accountType) {
            return redirect()->route('landing');
        }

        return $next($request);
    }
}
