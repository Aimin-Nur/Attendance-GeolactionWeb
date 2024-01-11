<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Absen;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $hariini =  date("Y-m-d");
        $today = Carbon::now()->locale('id_ID');
        $dayName = $today->dayName;
        $bulanini = date("m") * 1;
        $tahunini = date("Y");
        $nip = Auth::guard('karyawan')->user()->NIP;
        $karyawan = DB::table('pegawai')->where('NIP', $nip)->first();
        $presensiToday = DB::table('absen')->where('tgl_absen',$hariini)->where('NIP',$nip)->first();

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

        $rekapIzin = DB::table('perizinan')->selectRaw('COUNt(IF(status="Sakit",1,0)) as jmlhSakit, COUNT(IF(status="Izin",1,0)) as jmlhIzin')->where('NIP', $nip)
            ->whereRaw('MONTH(tgl_izin) = "' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_izin) = "' . $tahunini . '"')
            ->where('status_approved', 1)
            ->first();


        $telat = DB::table('absen')->selectRaw('COUNT(nip) as jml_telat')
        ->where('nip', $nip)
        ->whereRaw('MONTH(tgl_absen) = "' . $bulanini . '"')
        ->whereRaw('YEAR(tgl_absen) = "' . $tahunini . '"')
        ->where('status', "terlambat")
        ->first();


        $cekAbsenToday = DB::table('absen')
                ->where('nip', $nip)
                ->whereDate('tgl_absen', '=', $today)
                ->orderBy('tgl_absen')
                ->count();

        $historyKedatanganHarian = DB::table('absen')
            ->where('nip', $nip)
            ->whereRaw('DATE(tgl_absen) = "' . $hariini . '"')
            ->whereRaw('MONTH(tgl_absen) = "' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_absen) = "' . $tahunini . '"')
            ->whereNotNull('jam_in')
            ->orderBy('tgl_absen')
            ->get();

        $historyKepulanganHarian = DB::table('absen')
            ->where('nip', $nip)
            ->whereRaw('DATE(tgl_absen) = "' . $hariini . '"')
            ->whereRaw('MONTH(tgl_absen) = "' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_absen) = "' . $tahunini . '"')
            ->whereNotNull('jam_out')
            ->orderBy('tgl_absen')
            ->get();

        $historyBulaiIni = DB::table('absen')
            ->where('nip', $nip)
            ->whereRaw('MONTH(tgl_absen) = "' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_absen) = "' . $tahunini . '"')
            ->whereNotNull('jam_out')
            ->whereNotNull('jam_in')
            ->orderBy('tgl_absen')
            ->get();

        $cekHistoryBulaiIni = DB::table('absen')
            ->where('nip', $nip)
            ->whereRaw('MONTH(tgl_absen) = "' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_absen) = "' . $tahunini . '"')
            ->whereNotNull('jam_out')
            ->whereNotNull('jam_in')
            ->orderBy('tgl_absen')
            ->count();

        return view('dashboard.dashboard', compact('dayName','presensiToday', 'telat', 'namaBulan','bulanini','tahunini', 'rekapPresensi', 'karyawan', 'rekapIzin','historyKedatanganHarian','historyKepulanganHarian','cekAbsenToday','historyBulaiIni','cekHistoryBulaiIni'));
    }

    
}
