<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Absen;

class DashboardController extends Controller
{
    public function index()
    {
        $today = date("Y-m-d");
        $nip = Auth::guard('karyawan')->user()->NIP;
        $presensiToday = DB::table('absen')->where('tgl_absen',$today)->where('NIP',$nip)->first();
        return view('dashboard.dashboard', compact('presensiToday'));
    }
}
