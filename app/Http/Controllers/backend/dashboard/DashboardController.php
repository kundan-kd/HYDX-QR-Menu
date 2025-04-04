<?php

namespace App\Http\Controllers\backend\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboad()
    {
        return view('backend.index');
    }
   
    public function profile()
    {
        return view('backend.profile');
    }
    public function forgetpass()
    {
        return view('backend.auth.forget-password');
    }
    
}
