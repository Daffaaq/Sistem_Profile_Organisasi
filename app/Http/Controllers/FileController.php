<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\file;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    public function index(){
        $userRole = auth()->user()->role; // Mendapatkan peran pengguna

        if ($userRole == 'superadmin') {
            return view('superadmin.File.index');
        } elseif ($userRole == 'admin') {
            // Tambahkan logika atau tampilan yang sesuai untuk admin
            return view('admin.File.index');
        }

        return redirect('/login')->with('error', 'Unauthorized access. Please log in with the correct account.');
    }
}
