<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    //

    public function index(){
        return view('layouts.login');
    }

    public function authenticate(Request $request){
        session()->start();

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...

            // Get user details
            $user = $request->user();

            // Save User ID and Account Type in session
            session()->put('user_id', $user['id']);
            session()->put('account_type', $user['account_type']);
            
            $accountType = session()->get('account_type');
            // Redirect to dashboard
            switch($accountType){
                case 'student_assistant':
                    return redirect()->route('sa.dashboard');
                case 'sa_manager':
                    return redirect()->route('sa.manager.dashboard.ongoing');
                case 'office_admin':
                    return redirect()->route('office.dashboard');
                case '':
                    return redirect()->route('login');

            }        
        }
        return redirect()->back()->withErrors([
            'id_number' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }
}
/**
 * make login controller
 * make views for login,dashboard,sa,sa manager,office admin
 * make models and migrations
 * 
 * 
 */