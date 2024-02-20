<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\ModelKaryawan;
use App\Models\Absen;
use App\Models\ModelIzin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use App\Mail\Izin;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function dashboard(){
        $date = date("Y-m-d");
        $bulan = date("m");
        $pegawai = DB::table('pegawai')->count();
       
        $absenDay = DB::table('absen')
        ->whereRaw('DATE(tgl_absen)="' . $date . '"')
        ->count();

        $absenMonth = DB::table('absen')
        ->whereRaw('MONTH(tgl_absen)="' . $bulan . '"')
        ->count();


        $telat = "Terlambat";
        $telatDay = DB::table('absen')
        ->where('status', $telat)
        ->whereRaw('DATE(tgl_absen)="' . $date . '"')
        ->count();
        $telatMonth = DB::table('absen')
        ->where('status', $telat)
        ->whereRaw('MONTH(tgl_absen)="' . $bulan . '"')
        ->count();

        $ontime = "Tepat Waktu";
        $ontimeDay = DB::table('absen')
        ->where('status', $ontime)
        ->whereRaw('DATE(tgl_absen)="' . $date . '"')
        ->count();
        $ontimeMonth = DB::table('absen')
        ->where('status', $ontime)
        ->whereRaw('MONTH(tgl_absen)="' . $bulan . '"')
        ->count();

        $izin = "Izin";
        $pegawaiIzin = DB::table('perizinan')
        ->where('status', $izin)
        ->whereRaw('DATE(tgl_izin)="' . $date . '"')
        ->count();
        $pegawaiIzinMonth = DB::table('perizinan')
        ->where('status', $izin)
        ->whereRaw('MONTH(tgl_izin)="' . $bulan . '"')
        ->count();

        $sakit = "Sakit";
        $pegawaiSakit = DB::table('perizinan')
        ->where('status', $sakit)
        ->whereRaw('DATE(tgl_izin)="' . $date . '"')
        ->count();
        $pegawaiSakitMonth = DB::table('perizinan')
        ->where('status', $sakit)
        ->whereRaw('MONTH(tgl_izin)="' . $bulan . '"')
        ->count();

        $approval = "Sudah Tervalidasi";
        $approvalPerizinan = DB::table('perizinan')
        ->where('status_approved', $approval)
        ->whereRaw('DATE(tgl_izin)="' . $date . '"')
        ->count();
        $approvalPerizinanMonth = DB::table('perizinan')
        ->where('status_approved', $approval)
        ->whereRaw('MONTH(tgl_izin)="' . $bulan . '"')
        ->count();

        $nonapproval = NULL;
        $belumApproval = DB::table('perizinan')
        ->where('status_approved', $nonapproval)
        ->whereRaw('DATE(tgl_izin)="' . $date . '"')
        ->count();
        $belumApprovalMonth = DB::table('perizinan')
        ->where('status_approved', $nonapproval)
        ->whereRaw('MONTH(tgl_izin)="' . $bulan . '"')
        ->count();

        $topFastAbsen = DB::table('absen')
        ->select('absen.*', 'nama_lengkap', 'jabatan', 'jam_in','foto_in','foto_out','jam_out','location')
        ->join('pegawai', 'absen.NIP', '=', 'pegawai.NIP')
        ->where('tgl_absen', $date)
        ->orderBy('jam_in')
        ->take(5)
        ->get();

        $cekAbsen = DB::table('absen')
        ->where('tgl_absen', $date)
        ->count();

        return view ('admin.dashboard', compact('pegawai','date','absenDay', 'absenMonth', 'telatDay','telatMonth','ontimeDay','ontimeMonth','pegawaiIzin','pegawaiIzinMonth','pegawaiSakit','pegawaiSakitMonth','approvalPerizinan','approvalPerizinanMonth','belumApproval','belumApprovalMonth','topFastAbsen','cekAbsen'));
    }

    public function dataKaryawan(Request $request){
      
        $query = ModelKaryawan::query();
        $query->orderBy('nama_lengkap');
    
        if(!empty($request->nama_karyawan)){
            $query->where('nama_lengkap', 'like', '%' . $request->nama_karyawan . '%');
        }
    
        $karyawan = $query->paginate(2);

        $dataKaryawan = DB::table('pegawai')->get();
        return view('admin.dataKaryawan', compact('dataKaryawan', 'karyawan'));
    }

    public function addKaryawan (Request $request){
        // Validasi data yang diunggah oleh pengguna
        $validator = Validator::make($request->all(), [
            'NIP' => 'required',
            'nama' => 'required',
            'email' => 'required|email',
            'nomor_hp' => 'required',
            'jabatan' => 'required',
        ], [
            'NIP.required' => 'Kolom Nomor Induk Karyawan wajib diisi.',
            'nama.required' => 'Kolom Nama Lengkap Karyawab wajib diisi.',
            'email.required' => 'Kolom Email wajib diisi.',
            'email.email' => 'Format Email tidak valid.',
            'nomor_hp.required' => 'Kolom Nomor Hp Karyawan wajib diisi.',
            'jabatan.required' => 'Kolom Jabatan Karyawan wajib diisi.',
            
        ]);

        if ($validator->fails()) {
            return redirect('/dataKaryawan')
                ->withErrors($validator)
                ->withInput();
        }

        $addKaryawan = new ModelKaryawan;
        $addKaryawan->NIP = $request->input('NIP');
        $addKaryawan->nama_lengkap = $request->input('nama');
        $addKaryawan->no_hp = $request->input('nomor_hp');
        $addKaryawan->jabatan = $request->input('jabatan');
        $addKaryawan->email = $request->input('email');
        $addKaryawan->password = $request->input('password');

        $addKaryawan->save();
        return redirect('/dataKaryawan')->with('success', 'Data Karyawan berhasil Ditambahkan.');
    }

    public function editKaryawan(Request $request, $nip)
    {
        $karyawan = ModelKaryawan::where('NIP', $nip)->first();
        
        if (!$karyawan) {
            return redirect('/dataKaryawan')->with('error', 'Pegawai tidak ditemukan');
        }

        // Validasi data yang diinput oleh pengguna
        $this->validate($request, [
            'nama' => 'required',
            'nomor_hp' => 'required',
            'jabatan' => 'required',
            'email' => 'required|email',
        ]);

        // Simpan perubahan data
        $karyawan->nama_lengkap = $request->input('nama');
        $karyawan->no_hp = $request->input('nomor_hp');
        $karyawan->jabatan = $request->input('jabatan');
        $karyawan->email = $request->input('email');

        $karyawan->update();

        return redirect('/dataKaryawan')->with('edit', 'Data Karyawan berhasil diubah');
    }

    public function deleteKaryawan($nip)
    {
        $karyawan = ModelKaryawan::where('NIP', $nip)->first();

        if (!$karyawan) {
            return redirect('/dataKaryawan')->with('error', 'Pegawai tidak ditemukan');
        }

        $karyawan->delete();

        return redirect('/dataKaryawan')->with('delete', 'Data Karyawan berhasil dihapus');
    }


    public function monitoringAbsen()
    {
        $presensi = DB::table('absen')
            ->select('absen.*', 'nama_lengkap')
            ->join('pegawai', 'absen.NIP', '=', 'pegawai.NIP')
            ->get();
        return view('admin.monitoring', compact('presensi'));
    }

    public function getMonitoring(Request $request)
    {
        if($request->has('search')){
            $presensi = DB::table('absen')
            ->select('absen.*', 'nama_lengkap', 'jabatan', 'jam_in','foto_in','foto_out','jam_out','location')
            ->join('pegawai', 'absen.NIP', '=', 'pegawai.NIP')
            ->where('tgl_absen', 'LIKE', '%' .$request->search. '%')
            ->get();
        }else{
            $presensi = "Silahkan Masukkan Tanggal Absensi yang Anda ingin lihat.";
        }

        return view('admin.getMonitoring', compact('presensi'));
    }

    public function monitoringPerizinan(Request $request){
        // $query = ModelKaryawan::query();
        // $query->orderBy('nama_lengkap');
    
        // if(!empty($request->nama_karyawan)){
        //     $query->where('nama_lengkap', 'like', '%' . $request->nama_karyawan . '%');
        // }
    
        // $dataKaryawan =  DB::table('perizinan')->get();
        // // ->select('perizinan1.*', 'pegawai.nama_lengkap', 'pegawai.jabatan')
        // // ->join('pegawai', 'perizinan1.NIP', '=', 'pegawai.NIP')
        // // ->where('perizinan1.tgl_izin', 'LIKE', '%' . $request->search . '%')
        // // ->simplePaginate(5);

        $dataKaryawan = ModelIzin::with('pegawai')->get();
    

        $countData =  DB::table('perizinan')->count();
        return view('admin.monitoringIzin', compact('dataKaryawan', 'countData'));
    }


    public function getNameKaryawan(Request $request)
    {
        if($request->has('nama_karyawan')){
            $dataKaryawan = DB::table('pegawai')
            ->where('nama_lengkap', 'LIKE', '%' .$request->nama_karyawan. '%')
            ->first();
        }else{
            $dataKaryawan = "Tidak Ditemukan.";
        }

        return view('admin.karyawanGetName', compact('dataKaryawan'));
    }


    public function perizinanKaryawan (Request $request, $id)
    {
        $izin = ModelIzin::where('id', $id)->first();

        $emailKaryawan = $request->input('field_email');
        

        // Simpan perubahan data
        $izin->status_approved = $request->input('status_approved');
        $izin->update();
        Mail::to($emailKaryawan)->send(new Izin($izin));
        return redirect('/monitoring/perizinan')->with('success', 'Data Perizinan berhasil divaldasi');
    }

    public function laporanAbsensi()
    {
        $karyawan = DB::table('pegawai')->orderBy('nama_lengkap')->get();
        $namaBulan =  ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
       return view('admin.laporanAbsensi', compact('namaBulan', 'karyawan')); 
    }


    public function cetakLaporan(Request $request)
    {
        $nip = $request->nip;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namaBulan =  ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $karyawan = DB::table('pegawai')->where('NIP', $nip)->first();
        $absen = DB::table('absen')
        ->where('NIP', $nip)
        ->whereRaw('MONTH(tgl_absen)="' . $bulan . '"')
        ->whereRaw('YEAR(tgl_absen)="' . $tahun . '"')
        ->get();


        $hadir = DB::table('absen')
                ->where('NIP', $nip)
                ->whereRaw('MONTH(tgl_absen)="' . $bulan . '"')
                ->whereRaw('YEAR(tgl_absen)="' . $tahun . '"')
                ->count();
                
        $cekIzin = DB::table('perizinan')
        ->where('NIP', $nip)
        ->whereRaw('MONTH(tgl_izin)="' . $bulan . '"')
        ->whereRaw('YEAR(tgl_izin)="' . $tahun . '"')
        ->count();

        $statusIzin = "Izin";
        $izin = DB::table('perizinan')
            ->where('NIP', $nip)
            ->whereRaw('MONTH(tgl_izin)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_izin)="' . $tahun . '"')
            ->where('status', $statusIzin)
            ->get();

        $jumlahIzin = $izin->count();

        $statusSakit = "Sakit";
        $sakit = DB::table('perizinan')
        ->where('NIP', $nip)
        ->whereRaw('MONTH(tgl_izin)="' . $bulan . '"')
        ->whereRaw('YEAR(tgl_izin)="' . $tahun . '"')
        ->where('status', $statusSakit)
        ->get();

        $jumlahSakit = $sakit->count();

        $statusTelat = "Terlambat";
        $telat = DB::table('absen')->where('NIP', $nip)
        ->whereRaw('MONTH(tgl_absen)="' . $bulan . '"')
        ->whereRaw('YEAR(tgl_absen)="' . $tahun . '"')
        ->where('status', $statusTelat)
        ->get();

        $jumlahTelat = $telat->count();

        $statusOntime = "Tepat Waktu";
        $ontime = DB::table('absen')->where('NIP', $nip)
        ->whereRaw('MONTH(tgl_absen)="' . $bulan . '"')
        ->whereRaw('YEAR(tgl_absen)="' . $tahun . '"')
        ->where('status', $statusOntime)
        ->get();

        $jumlahOntime = $ontime->count();

        $dataPerizinan = DB::table('perizinan')
                ->where('NIP', $nip)
                ->whereRaw('MONTH(tgl_izin)="' . $bulan . '"')
                ->whereRaw('YEAR(tgl_izin)="' . $tahun . '"')
                ->get();

        // $pdf = Pdf::loadView('admin.cetakLaporan', ['nip' => $nip, 'bulan' => $bulan, 'tahun' => $tahun, 'namaBulan' => $namaBulan, 'karyawan' => $karyawan, 'absen' => $absen, 'hadir' => $hadir, 'jumlahIzin' => $jumlahIzin, 'jumlahSakit' => $jumlahSakit, 'jumlahTelat' => $jumlahTelat, 'jumlahOntime' => $jumlahOntime, 'cekIzin' => $cekIzin, 'dataPerizinan' => $dataPerizinan]);
        // return $pdf->download('laporan.pdf');

        return view('admin.cetakLaporan', compact('nip','bulan', 'karyawan', 'namaBulan','tahun','jumlahTelat', 'jumlahIzin', 'jumlahOntime', 'jumlahTelat', 'jumlahSakit','cekIzin', 'absen','hadir','dataPerizinan'));
       
    }

    public function cetakRekapan(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namaBulan =  ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $rekap = DB::table('absen')
            ->selectRaw('absen.NIP, nama_lengkap,
                MAX(IF(DAY(tgl_absen) = 1, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_1`,
                MAX(IF(DAY(tgl_absen) = 2, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_2`,
                MAX(IF(DAY(tgl_absen) = 3, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_3`,
                MAX(IF(DAY(tgl_absen) = 4, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_4`,
                MAX(IF(DAY(tgl_absen) = 5, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_5`,
                MAX(IF(DAY(tgl_absen) = 6, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_6`,
                MAX(IF(DAY(tgl_absen) = 7, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_7`,
                MAX(IF(DAY(tgl_absen) = 8, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_8`,
                MAX(IF(DAY(tgl_absen) = 9, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_9`,
                MAX(IF(DAY(tgl_absen) = 10, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_10`,
                MAX(IF(DAY(tgl_absen) = 11, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_11`,
                MAX(IF(DAY(tgl_absen) = 12, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_12`,
                MAX(IF(DAY(tgl_absen) = 13, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_13`,
                MAX(IF(DAY(tgl_absen) = 14, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_14`,
                MAX(IF(DAY(tgl_absen) = 15, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_15`,
                MAX(IF(DAY(tgl_absen) = 16, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_16`,
                MAX(IF(DAY(tgl_absen) = 17, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_17`,
                MAX(IF(DAY(tgl_absen) = 18, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_18`,
                MAX(IF(DAY(tgl_absen) = 19, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_19`,
                MAX(IF(DAY(tgl_absen) = 20, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_20`,
                MAX(IF(DAY(tgl_absen) = 21, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_21`,
                MAX(IF(DAY(tgl_absen) = 22, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_22`,
                MAX(IF(DAY(tgl_absen) = 23, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_23`,
                MAX(IF(DAY(tgl_absen) = 24, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_24`,
                MAX(IF(DAY(tgl_absen) = 25, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_25`,
                MAX(IF(DAY(tgl_absen) = 26, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_26`,
                MAX(IF(DAY(tgl_absen) = 27, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_27`,
                MAX(IF(DAY(tgl_absen) = 28, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_28`,
                MAX(IF(DAY(tgl_absen) = 29, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_29`,
                MAX(IF(DAY(tgl_absen) = 30, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_30`,
                MAX(IF(DAY(tgl_absen) = 31, CONCAT(jam_in,"-", IFNULL(jam_out,"00:00:00")), NULL)) as `Tgl_31`')
            ->join('pegawai', 'absen.NIP', '=', 'pegawai.NIP')
            ->whereRaw('MONTH(tgl_absen)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_absen)="' . $tahun . '"')
            ->groupByRaw('absen.NIP,nama_lengkap')
            ->get();

        
            $Rekapizin = DB::table('perizinan')
            ->selectRaw('perizinan.NIP, nama_lengkap,
                        MAX(IF(DAY(tgl_izin) = 1, status, NULL)) as Tgl_1,
                        MAX(IF(DAY(tgl_izin) = 2, status, NULL)) as Tgl_2,
                        MAX(IF(DAY(tgl_izin) = 3, status, NULL)) as Tgl_3,
                        MAX(IF(DAY(tgl_izin) = 4, status, NULL)) as Tgl_4,
                        MAX(IF(DAY(tgl_izin) = 5, status, NULL)) as Tgl_5,
                        MAX(IF(DAY(tgl_izin) = 6, status, NULL)) as Tgl_6,
                        MAX(IF(DAY(tgl_izin) = 7, status, NULL)) as Tgl_7,
                        MAX(IF(DAY(tgl_izin) = 8, status, NULL)) as Tgl_8,
                        MAX(IF(DAY(tgl_izin) = 9, status, NULL)) as Tgl_9,
                        MAX(IF(DAY(tgl_izin) = 10, status, NULL)) as Tgl_10,
                        MAX(IF(DAY(tgl_izin) = 11, status, NULL)) as Tgl_11,
                        MAX(IF(DAY(tgl_izin) = 12, status, NULL)) as Tgl_12,
                        MAX(IF(DAY(tgl_izin) = 13, status, NULL)) as Tgl_13,
                        MAX(IF(DAY(tgl_izin) = 14, status, NULL)) as Tgl_14,
                        MAX(IF(DAY(tgl_izin) = 15, status, NULL)) as Tgl_15,
                        MAX(IF(DAY(tgl_izin) = 16, status, NULL)) as Tgl_16,
                        MAX(IF(DAY(tgl_izin) = 17, status, NULL)) as Tgl_17,
                        MAX(IF(DAY(tgl_izin) = 18, status, NULL)) as Tgl_18,
                        MAX(IF(DAY(tgl_izin) = 19, status, NULL)) as Tgl_19,
                        MAX(IF(DAY(tgl_izin) = 20, status, NULL)) as Tgl_20,
                        MAX(IF(DAY(tgl_izin) = 21, status, NULL)) as Tgl_21,
                        MAX(IF(DAY(tgl_izin) = 22, status, NULL)) as Tgl_22,
                        MAX(IF(DAY(tgl_izin) = 23, status, NULL)) as Tgl_23,
                        MAX(IF(DAY(tgl_izin) = 24, status, NULL)) as Tgl_24,
                        MAX(IF(DAY(tgl_izin) = 25, status, NULL)) as Tgl_25,
                        MAX(IF(DAY(tgl_izin) = 26, status, NULL)) as Tgl_26,
                        MAX(IF(DAY(tgl_izin) = 27, status, NULL)) as Tgl_27,
                        MAX(IF(DAY(tgl_izin) = 28, status, NULL)) as Tgl_28,
                        MAX(IF(DAY(tgl_izin) = 29, status, NULL)) as Tgl_29,
                        MAX(IF(DAY(tgl_izin) = 30, status, NULL)) as Tgl_30,
                        MAX(IF(DAY(tgl_izin) = 31, status, NULL)) as Tgl_31')
            ->join('pegawai', 'perizinan.NIP', '=', 'pegawai.NIP')
            ->whereMonth('tgl_izin', '=', $bulan)
            ->whereYear('tgl_izin', '=', $tahun)
            ->groupBy('perizinan.NIP', 'nama_lengkap')
            ->get();
        


            $statusTelat = "Terlambat";
            $pegawaiTerlambat = DB::table('absen')
                ->select('pegawai.NIP', 'pegawai.nama_lengkap', DB::raw('COUNT(*) as totalTelat'))
                ->join('pegawai', 'absen.NIP', '=', 'pegawai.NIP')
                ->where('absen.status', $statusTelat)
                ->whereRaw('MONTH(tgl_absen)="' . $bulan . '"')
                ->groupBy('pegawai.NIP', 'pegawai.nama_lengkap')
                ->orderByDesc('totalTelat')
                ->first();

            $jumlahTelat = $pegawaiTerlambat ? $pegawaiTerlambat->totalTelat : 0;


            $statusIzin = "Izin";
            $pegawaiIzin = DB::table('perizinan')
                ->select('pegawai.NIP', 'pegawai.nama_lengkap', DB::raw('COUNT(*) as totalIzin'))
                ->join('pegawai', 'perizinan.NIP', '=', 'pegawai.NIP')
                ->where('perizinan.status', $statusIzin)
                ->whereRaw('MONTH(tgl_izin)="' . $bulan . '"')
                ->groupBy('pegawai.NIP', 'pegawai.nama_lengkap')
                ->orderByDesc('totalIzin')
                ->first();

            $jumlahIzin = $pegawaiIzin ? $pegawaiIzin->totalIzin : 0;

            $statusSakit = "Sakit";
            $pegawaiSakit = DB::table('perizinan')
                ->select('pegawai.NIP', 'pegawai.nama_lengkap', DB::raw('COUNT(*) as totalSakit'))
                ->join('pegawai', 'perizinan.NIP', '=', 'pegawai.NIP')
                ->where('perizinan.status', $statusSakit)
                ->whereRaw('MONTH(tgl_izin)="' . $bulan . '"')
                ->groupBy('pegawai.NIP', 'pegawai.nama_lengkap')
                ->orderByDesc('totalSakit')
                ->first();

            $jumlahSakit = $pegawaiSakit ? $pegawaiSakit->totalSakit : 0;

        return view('admin.cetakRekap', compact('bulan','namaBulan','tahun','rekap','jumlahTelat','pegawaiTerlambat','pegawaiIzin','pegawaiSakit','Rekapizin'));


        // $pdf = Pdf::loadView('admin.cetakRekap', ['bulan' => $bulan,  'namaBulan' => $namaBulan, 'tahun' => $tahun, 'rekap' => $rekap, 'pegawaiTerlambat' => $pegawaiTerlambat, 'pegawaiIzin' => $pegawaiIzin, 'pegawaiSakit' => $pegawaiSakit,   'jumlahTelat' => $jumlahTelat, 'Rekapizin' => $Rekapizin]);
        // return $pdf->download('rekap.pdf');
    }


}