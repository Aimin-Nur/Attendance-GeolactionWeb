<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\ModelKaryawan;

class AdminController extends Controller
{
    public function dashboard(){
        $isActive = request()->is('dashboardAdmin') ? 'active' : '';
        return view ('admin.dashboard', compact('isActive'));
    }

    public function dataKaryawan(){
        $isActive = request()->is('dataKaryawan') ? 'active' : '';
        $dataKaryawan = DB::table('pegawai')->get();
        return view('admin.dataKaryawan', compact('dataKaryawan', 'isActive'));
    }
}
