<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardSuperadminController extends Controller
{
    public function index(){
        return view('superadmin.dashboard.index');
    }
}
