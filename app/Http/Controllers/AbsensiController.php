<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Absen;
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
        $folderPath = "public/uploads/absensi/";
        $formatName = $nip . "-" . $tgl_presensi;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;

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
        }else{
            $data = [
                'NIP' => $nip,
                'tgl_absen' => $tgl_presensi,
                'jam_in' => $jam,
                'foto_in' => $fileName,
                'location' => $lokasi,
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
        $password = Hash::make($request->paswword);
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
}
