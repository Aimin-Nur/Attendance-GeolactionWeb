<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AbsensiController;

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


Route::middleware(['guest:karyawan'])->group(function (){
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/LoginKaryawan', [AuthController::class, 'LoginKaryawan']);    
});

Route::middleware(['auth:karyawan'])->group(function (){
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/LogoutKaryawan', [AuthController::class, 'LogoutKaryawan']);

    // Absensi karyawan
    Route::get('/absen/absensi', [AbsensiController::class, 'AbsensiKaryawan']);
    Route::post('/absen/saveAbsen', [AbsensiController::class, 'saveAbsen']);

    // Edit Profile Karyawan
    Route::get('/editProfile', [AbsensiController::class, 'editProfil'])->name('editProfile');
    Route::post('/absen/{NIP}/updateProfil', [AbsensiController::class, 'updateProfil']);

});

