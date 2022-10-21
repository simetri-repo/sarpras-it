<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function showuser()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $data = DB::table('t_user')
                ->select('*')
                ->join('r_divisi', 't_user.id_divisi', '=', 'r_divisi.id_divisi')
                ->get();
            $divisi = DB::table('r_divisi')
                ->select('*')
                ->get();

            return view('admin.datauser', compact('data', 'divisi'));
        }
    }

    public function showuserid($id)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $data = DB::table('t_user')
                ->select('*')
                ->join('r_divisi', 't_user.id_divisi', '=', 'r_divisi.id_divisi')
                ->where('id_user', $id)
                ->first();
            $divisi = DB::table('r_divisi')
                ->select('*')
                ->get();

            return view('admin.datauseredit', compact('data', 'divisi'));
        }
    }

    public function saveuser(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $update_at = new Controller;



            // return $request->all();

            $ns = DB::table('t_user')
                ->select('*')
                ->where('nik', $request->nik)
                ->count();

            $ns2 = DB::table('t_user')
                ->select('*')
                ->where('nama_user', $request->nama_user)
                ->count();
            // return $ns;
            if ($ns == 1) {
                alert()->error('Error Saved', 'NIK sudah ada!')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('/showuser');
            } elseif ($ns2 == 1) {
                alert()->error('Error Saved', 'Nama User sudah ada!')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('/showuser');
            } else {
                $status_akun = 9;

                $a = md5($request->nik);
                $b = md5("simetrisar123");
                $c = $a . $b;
                $pass = md5($c);

                $save = DB::table('t_user')
                    ->insert([

                        'nik' => $request->nik,
                        'nama_user' => $request->nama_user,
                        'password' => $pass,
                        'id_divisi' => $request->divisi,
                        'role' => $request->role,
                        'status_akun' => $status_akun,
                        'update_at' => $update_at->update_at(),
                        'update_by' => session('id_pic'),

                    ]);
                alert()->success('Data Saved', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('/showuser');
            }
        }
    }

    public function v_nik(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $data = DB::table('t_user')
                ->select('*')
                ->where('nik', $request->nik)
                ->count();
            // $data = count$a;

            return response()->json($data);
            // return $data;
        }
    }

    public function v_username(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $data = DB::table('t_user')
                ->select('*')
                ->where('nama_user', $request->nama_user)
                ->count();

            return response()->json($data);
        }
    }

    public function edituser(Request $request, $id)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            $update_at = new Controller;
            $edit = DB::table('t_user')
                ->where('id_user', $id)
                ->update([

                    'nik' => $request->nik,
                    'nama_user' => $request->nama_user,
                    'id_divisi' => $request->divisi,
                    'role' => $request->role,
                    'status_akun' => $request->status_akun,
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic')

                ]);
            alert()->success('Data Saved', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
            return redirect('showuserid/' . $id);
        }
    }

    public function resetpass($nik, $id)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $a = md5($nik);
            $b = md5("simetrisar123");
            $c = $a . $b;
            $pass = md5($c);

            $respass = DB::table('t_user')
                ->where('id_user', $id)
                ->update([
                    'password' => $pass,
                ]);
            alert()->info('Password successfully reset.', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
            return redirect('showuserid/' . $id);
        }
    }

    public function deleteuser($id)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $delete = DB::table('t_user')
                ->where('id_user', $id)
                ->delete();
            alert()->info('Data Deleted', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
            return redirect('showuser');
        }
    }

    public function myaccount()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $nik = session('id_pic');
            $data = DB::table('t_user')
                ->select('*')
                ->join('r_divisi', 't_user.id_divisi', '=', 'r_divisi.id_divisi')
                ->where('nik', $nik)
                ->first();
            $divisi = DB::table('r_divisi')
                ->select('*')
                ->get();

            // dd($data);

            return view('admin.myaccount', compact('data', 'divisi'));
        }
    }
}
