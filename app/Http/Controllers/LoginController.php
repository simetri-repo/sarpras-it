<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function authLogin(Request $request)
    {


        // if (session('id_pic') == null) {
        //     Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
        //     return redirect('Logout');
        // } else {
        // }

        // return $request->all();

        $a = md5($request->username);
        $b = md5($request->password);
        $c = $a . $b;
        $pass = md5($c);

        // return $pass;

        $cek = DB::table('t_user')
            ->where('nik', $request->username)
            ->where('password', $pass)
            ->count();
        if ($cek == 1) {
            $data = DB::table('t_user')
                ->where('nik', $request->username)
                ->where('password', $pass)
                ->first();
            if ($data->status_akun == 1) {
                session::put('username', $data->nama_user);
                session::put('id_pic', $data->nik);
                session::put('role', $data->role);
                session::put('id_divisi', $data->id_divisi);
                // dd($data);
                return redirect('home');
            } else {
                Alert::warning('Oops!', 'Akun Anda Belum Aktif, Silahkan Hubungi Admin!');
                return redirect('/');
            }
        } else {
            Alert::error('Akun Tidak Ditemukan', 'Akun anda tidak ditemukan, cek kembali username dan password anda!');
            return redirect('/');
        }
    }

    public function authLogout()
    {
        session::forget('username');
        session::forget('id_pic');
        session::forget('role');
        session::forget('id_divisi');
        return redirect('/');
    }
}
