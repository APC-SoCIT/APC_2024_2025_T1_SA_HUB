<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuidanceController extends Controller
{
    //

    public function dashboard(){
        return view('guidance.guidance_dashboard');
    }
}