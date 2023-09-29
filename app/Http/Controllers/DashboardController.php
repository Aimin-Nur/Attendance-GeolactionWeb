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
        $bulanini = date("m") * 1;
        $tahunini = date("Y");
        $nip = Auth::guard('karyawan')->user()->NIP;
        $karyawan = DB::table('pegawai')->where('NIP', $nip)->first();
        $presensiToday = DB::table('absen')->where('tgl_absen',$today)->where('NIP',$nip)->first();

        $historybulanini = DB::table('absen')
            ->where('nip', $nip)
            ->whereRaw('MONTH(tgl_absen) = "' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_absen) = "' . $tahunini . '"')
            ->orderBy('tgl_absen')
            ->get();

        $namaBulan =  ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        // dd($namaBulan[$bulanini]);

        $rekapPresensi = DB::table('absen')->selectRaw('COUNT(nip) as jml_hadir')
            ->where('nip', $nip)
            ->whereRaw('MONTH(tgl_absen) = "' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_absen) = "' . $tahunini . '"')
            ->first();

        return view('dashboard.dashboard', compact('presensiToday', 'namaBulan','bulanini','tahunini', 'rekapPresensi', 'karyawan'));
    }
}
