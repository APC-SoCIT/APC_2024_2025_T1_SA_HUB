<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                if ($user->hasRole('office_admin')) {
                    return redirect()->route('office.dashboard'); // Redirect to office_admin dashboard
                } elseif ($user->hasRole('sa_manager')) {
                    return redirect()->route('sa.manager.dashboard.ongoing'); // Redirect to sa_manager dashboard
                } elseif ($user->hasRole('student_assistant')) {
                    return redirect()->route('sa.dashboard'); // Redirect to student_assistant dashboard
                } elseif ($user->hasRole('guidance_office')) {
                    return redirect()->route('guidance.dashboard'); // Redirect to guidance dashboard
                }
                // Default redirection if no role is matched
                return redirect()->route('landing'); // Or wherever you want to send them
            }
        }

        return $next($request);
    }
}
