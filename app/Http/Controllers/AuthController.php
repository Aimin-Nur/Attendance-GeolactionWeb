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
            return redirect('/')->with(['warning' => 'NIP atau Password Anda tidak terdaftar.']);
           }
    }

    public function LogoutKaryawan()
    {
        if(Auth::guard('karyawan')->check()){
            Auth::guard('karyawan')->logout();
            return redirect('/');
        }
    }

    public function LoginAdmin(Request $request)
    {
        if(Auth::guard('admin')->attempt([
            'email' => $request -> email,
            'password' => $request->password,
            ])){
            return redirect('/dashboardAdmin');
           }else{
            return redirect('/portal')->with(['warning' => 'Email atau Password Anda tidak terdaftar.']);
           }
    }


    public function LogoutAdmin()
    {
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
            return redirect('/portal')->with(['sukses' => 'Anda Berhasil Logout.']);;
        }
    }
}

