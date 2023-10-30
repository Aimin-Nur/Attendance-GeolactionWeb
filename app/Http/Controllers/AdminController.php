<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\ModelKaryawan;
use Illuminate\Support\Facades\Validator;

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
}
