<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Bimbingan;
use App\Models\Pelanggaran;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()->hasRole('siswa')) {
            return redirect()->route('profile.student');
        }

        return view('admin.dashboard.index', [
            'teacher' => Teacher::all(),
            'student' => Student::all(),
            'bimbingan' => Bimbingan::all(),
            'pelanggaran' => Pelanggaran::all(),
        ]);
    }
}
