<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $segment = 'dashboard';

  
        return view('dashboard', compact('segment'));
    }
}
