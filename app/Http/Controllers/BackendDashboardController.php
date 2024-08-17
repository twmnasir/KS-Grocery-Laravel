<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackendDashboardController extends Controller
{
    function index(){
        return view('backend.dashboard');
    }
}
