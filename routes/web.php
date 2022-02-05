<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Models\Pelanggaran;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

// Route::get('/jenispelanggaran', function() {
//     return view('jenispelanggaran', [
//       'pelanggaran' => Pelanggaran::all()
//     ]);
//   })->name('front.mobil');

Auth::routes();

//===========================================================================
//===========================================================================
//===========================================================================

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function() {

  //Dashboard
  Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

  Route::group(['middleware' => ['role:superadmin|guru']], function() {    
  
    //Profile
    Route::get('profile-superadmin', \App\Http\Livewire\ProfileTeacher::class)->name('profile.superadmin');
    Route::get('profile-teacher', \App\Http\Livewire\ProfileTeacher::class)->name('profile.teacher');
    
    //Teachers
    Route::get('teachers', \App\Http\Livewire\DataTeachers::class)->name('teachers');
    
    //students
    Route::get('students', \App\Http\Livewire\DataStudents::class)->name('students');
    
    //bimbingan
    Route::get('bimbingan', \App\Http\Livewire\DataBimbingan::class)->name('bimbingan');
  
    //Pelanggaran
    Route::get('pelanggaran', \App\Http\Livewire\DataPelanggaran::class)->name('pelanggaran');

  });

  //Profile Student
  Route::get('profile-student', \App\Http\Livewire\ProfileStudent::class)->name('profile.student');


});

//===========================================================================
//===========================================================================
//===========================================================================

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', function() {
    return redirect()->route('dashboard');
});

Route::get('/password/email', function() {
    return redirect()->route('dashboard');
});

Route::get('/password/reset', function() {
    return redirect()->route('dashboard');
});
Route::get('/register', function() {
    return redirect()->route('dashboard');
});
