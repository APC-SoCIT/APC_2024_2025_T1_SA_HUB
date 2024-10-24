<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('office_admin') ) {
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
