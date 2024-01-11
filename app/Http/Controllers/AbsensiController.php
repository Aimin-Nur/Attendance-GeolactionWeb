<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Public;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Absen;
use App\Models\ModelIzin;
use App\Models\ModelKaryawan;
use Illuminate\Support\Facades\Mail;
use App\Mail\PemberitahuanIzin;
use App\Mail\SavePerizinan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AbsensiController extends Controller
{
    public function AbsensiKaryawan()
    {
        $today =  date("Y-m-d");
        $nip = Auth::guard('karyawan')->user()->NIP;
        $cek = DB::table('absen')->where('tgl_absen', $today)->where('NIP', $nip)->count();
        return view ('absen.absensi', compact('cek'));
    }

    public function saveAbsen(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lokasi' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            // Validasi gagal, kembalikan respons yang sesuai
            return response()->json(['error' => 'Data tidak valid'], 400);
        }

        $nip = Auth::guard('karyawan')->user()->NIP;
        $tgl_presensi = date("Y-m-d");
        $jam = $request->formattedTime;
        $lokasi = $request->lokasi;
        $image = $request->image;
        $folderPath = 'foto-absensi';
        $formatName = $nip . "-" . $tgl_presensi;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = 'public/' . $folderPath . '/' . $fileName;

        $cek = DB::table('absen')->where('tgl_absen', $tgl_presensi)->where('NIP', $nip)->count();
        if ($cek > 0) {
            $data_pulang = [
                'jam_out' => $jam,
                'foto_out' => $fileName,
                'location_out' => $lokasi,
            ];
            $update = DB::table('absen')->where('tgl_absen', $tgl_presensi)->where('NIP', $nip)->update($data_pulang);

            if ($update) {
                return response()->json(['success' => true, 'type' => 'out'], 200);
                Storage::put($file, $image_base64);
            } else {
                echo 1;
            }
        } else {
            // Cek apakah sudah lewat jam 08:00 pagi
            $jam_pagi = strtotime("08:00:00");
            $jam_absen = strtotime($jam);

            if ($jam_absen > $jam_pagi) {
                $status = 'Terlambat';

                // Menghitung keterlambatan dalam menit
                $keterlambatan_menit = round(($jam_absen - $jam_pagi) / 60);
                $data['keterlambatan'] = $keterlambatan_menit;
            } else {
                $status = 'Tepat Waktu';
            }

            $data = [
                'NIP' => $nip,
                'tgl_absen' => $tgl_presensi,
                'jam_in' => $jam,
                'foto_in' => $fileName,
                'location' => $lokasi,
                'status' => $status, 
                'keterlambatan' => $keterlambatan_menit, 
            ];

            try {
                // Simpan ke database menggunakan model Eloquent
                $result = Absen::create($data);

                // Simpan file
                Storage::put($file, $image_base64);

                if ($result) {
                    // Berhasil
                    return response()->json(['success' => true], 200);
                } else {
                    // Gagal
                    return response()->json(['error' => 'Gagal menyimpan data ke database'], 500);
                }
            } catch (\Exception $e) {
                // Tangani kesalahan
                return response()->json(['error' => 'Gagal menyimpan data. Pesan kesalahan: ' . $e->getMessage()], 500);
            }
        }
    }


    public function editProfil()
    {
        $nip = Auth::guard('karyawan')->user()->NIP;
        $karyawan = DB::table('pegawai')->where('NIP', $nip)->first();
        return view('absen.editProfil', compact('karyawan'));
    }

    public function updateProfil(Request $request)
    {
        $nip = Auth::guard('karyawan')->user()->NIP;
        $namaLengkap = $request->nama_lengkap;
        $no_hp = $request->no_hp;   
        $password = Hash::make($request->password);
        $karyawan = DB::table('pegawai')->where('NIP', $nip)->first();
        if($request->hasFile('foto')){
            $foto = $nip . "." . $request->file('foto')->getClientOriginalExtension();
        }else{
            $foto = $karyawan->foto;
        }
        if(!empty($request->password)){
            $data = [
                'nama_lengkap' => $namaLengkap,
                'no_hp' => $no_hp,
                'foto' => $foto
            ];
        }else{
            $data = [
                'nama_lengkap' => $namaLengkap,
                'no_hp' => $no_hp,
                'password' => $password,
                'foto' => $foto
            ];
        }
        $update = DB::table('pegawai')->where('NIP', $nip)->update($data);
        if($update){
            if($request->hasFile('foto')){
               $folderPath = "public/uploads/karyawan/";
               $request->file('foto')->storeAs($folderPath, $foto);
            }
            return Redirect::back()->with(['success' => 'Data Profil Berhasil Diupdate']);
        }else{
            return Redirect::back()->with(['error' => 'Data Profil Gagal Diupdate']);
        }
    }

    public function izin()
    {
        $nip = Auth::guard('karyawan')->user()->NIP;
        $izin = DB::table('perizinan')->where('NIP',$nip)->get();
        return view('absen.izin', compact('izin'));
    }

    public function formIzin()
    {
        return view('absen.formIzin');
    }

    public function saveIzin(Request $request)
    {
        $perizinan = new ModelIzin;
        $nip = Auth::guard('karyawan')->user()->NIP;
        
        $tgl_izin = $request->tgl_izin;
        $status = $request->status;
        $keterangan = $request->keterangan;
        $karyawan = ModelKaryawan::where('NIP', $nip)->first();

        if ($karyawan) {
            $email = $karyawan->email;

            // Langsung menyimpan email ke dalam satu variabel
            $emailVariable = $email;

            // Sekarang $emailVariable berisi nilai dari kolom 'email' untuk karyawan dengan NIP yang sesuai
            // Lakukan sesuatu dengan $emailVariable, misalnya tampilkan atau gunakan untuk keperluan lainnya
        } else {
            // Handle jika karyawan dengan NIP yang diberikan tidak ditemukan
        }

        $data = [
            'NIP' => $nip,
            'tgl_izin' => $tgl_izin,
            'status' => $status,
            'keterangan' => $keterangan,
        ];

        $mailAdmin = 'aiminnur1@gmail.com';

        $save = DB::table('perizinan')->insert($data);


        try {
            // Kirim email pemberitahuan ke admin
            Mail::to($mailAdmin)->send(new PemberitahuanIzin($perizinan));
        } catch (\Swift_TransportException $e) {
            // Terjadi kesalahan pengiriman email
            return redirect('/absen/izin')->with(['error' => 'Pemberitahuan Email Gagal dikirimkan, pastikan email karyawan email yang aktif']);
        }

        try {
            // Kirim email konfirmasi ke calon santri
            Mail::to($emailVariable)->send(new SavePerizinan($perizinan));
        } catch (\Swift_TransportException $e) {
            // Terjadi kesalahan pengiriman email
            return redirect('/absen/izin')->with(['error' => 'Pemberitahuan Email Gagal dikirimkan, pastikan email karyawan email yang aktif']);
        }

        if ($save) {
            return redirect('/absen/izin')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect('/absen/izin')->with(['error' => 'Data Gagal Disimpan']);
        }
    }
}
