<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminController;

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

Route::get('/portal', function () {
    return view('admin.loginAdmin');
})->name('loginadmin');
Route::post('/portal/LoginAdmin', [AuthController::class, 'LoginAdmin']);    

#BuG Login Admin
// Route::middleware(['guest:admin'])->group(function (){
//     Route::get('/panel', function () {
//         return view('admin.loginAdmin');
//     })->name('loginadmin');
//     Route::post('/portal/LoginAdmin', [AuthController::class, 'LoginAdmin']);    
// });

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

Route::middleware(['auth:admin'])->group(function (){
    Route::get('/dashboardAdmin', [AdminController::class, 'dashboard']);
    Route::get('/dataKaryawan', [AdminController::class, 'dataKaryawan']);
    Route::get('/LogoutAdmin', [AuthController::class, 'LogoutAdmin']);
    Route::post('/addKaryawan', [AdminController::class, 'addKaryawan']);
    Route::post('/editKaryawan/{NIP}', [AdminController::class, 'editKaryawan']);
    Route::post('/deleteKaryawan/{NIP}', [AdminController::class, 'deleteKaryawan']);
});


    

