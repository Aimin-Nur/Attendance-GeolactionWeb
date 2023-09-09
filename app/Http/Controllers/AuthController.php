<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function LoginKaryawan(Request $request)
    {
        if(Auth::guard('karyawan')->attempt([
            'NIP' => $request -> NIP,
            'password' => $request->password,
            ])){
            return redirect('/dashboard');
           }else{
            return redirect('/')->with(['warning' => 'Nik atau Password tidak terdaftar.']);
           }
    }

    public function LogoutKaryawan()
    {
        if(Auth::guard('karyawan')->check()){
            Auth::guard('karyawan')->logout();
            return redirect('/');
        }
    }
}

