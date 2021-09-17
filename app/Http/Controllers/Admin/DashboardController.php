<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()->hasRole('siswa')) {
            return redirect()->route('profile.student');
        }

        return view('admin.dashboard.index');
    }
}
