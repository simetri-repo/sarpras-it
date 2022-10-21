<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class PengajuanController extends Controller
{
    public function generate_token(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $dateT = date('ym');
            $dateTg = date('d');
            for ($i = 0; $i < $request->generate; $i++) {
                $rdm = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 5)), 0, 6);
                $test = DB::select('SELECT count(no_token) as a FROM t_pengajuan where no_token = ?', [$rdm]);
                if ($test[0]->a == 0) {
                    $token = $dateT . $rdm . $dateTg;
                    // echo $token . "<br/>";
                } else {
                    $rdm1 = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 5)), 0, 6);
                    $token = $dateT . $rdm1 . $dateTg;
                }
                echo $token . "<br/>";
            }
        }
    }
    public function showFormPengajuan()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $dt_jenis = DB::table('r_jenisbarang')
                ->get();
            // $atasan = DB::table('t_user')
            //     ->where('id_divisi', session('id_divisi'))
            //     ->where('role', '5')
            //     ->orWhere('role', '7')
            //     ->where('status_akun', '1')
            //     ->get();
            $a = session('id_divisi');
            $atasan = DB::select('SELECT * FROM t_user WHERE id_divisi = ? and role = 7 or role = 5 and id_divisi = ?', [$a, $a]);
            return view('divisi.formPengajuan', compact('dt_jenis', 'atasan'));
        }
    }

    public function showFormPengajuanAtasan()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $dt_jenis = DB::table('r_jenisbarang')
                ->get();
            return view('atasan.formPengajuan', compact('dt_jenis'));
        }
    }

    public function showFormPengajuanManager()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $dt_jenis = DB::table('r_jenisbarang')
                ->get();
            $atasan = DB::table('t_user')
                ->where('id_divisi', session('id_divisi'))
                ->where('role', '5')
                ->where('status_akun', '1')
                ->get();
            return view('manager.formPengajuan', compact('dt_jenis', 'atasan'));
        }
    }

    public function dataUnitById(Request $request)
    {
        $data = DB::table('t_unitbarang')
            ->where('jenis_unit', $request->id)
            ->where('status_unit', 1)
            ->get();
        return response()->json($data);
    }

    public function dataUnitByIdPart(Request $request)
    {
        $data = DB::table('t_unitbarang')
            ->where('id_unit', $request->id)
            ->get();
        return response()->json($data);
    }

    public function showDataPengajuan()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            return view('divisi.dataPengajuan');
        }
    }

    public function showDataPengajuanSaya()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {

            // $dt_pengajuan = DB::table('t_pengajuan')
            //     ->select('t_pengajuan.*', 't_unitbarang.nama_unit', 't_unitbarang.brand_unit', 't_unitbarang.tipe_unit', 't_approval.ket_approval')
            //     ->join('t_unitbarang', 't_pengajuan.id_unit', '=', 't_unitbarang.id_unit')
            //     ->join('t_approval', 't_pengajuan.no_token', '=', 't_approval.no_token')
            //     ->where('nik', session('id_pic'))
            //     ->groupBy('t_pengajuan.id_pengajuan')
            //     ->groupBy('t_unitbarang.id_unit')
            //     ->get();

            $dt_pengajuan = DB::select('SELECT * FROM t_pengajuan INNER JOIN t_unitbarang ON t_unitbarang.id_unit = t_pengajuan.id_unit INNER JOIN t_approval ON t_approval.no_token = t_pengajuan.no_token WHERE t_pengajuan.nik = ? GROUP BY t_pengajuan.id_pengajuan,t_unitbarang.id_unit', [session('id_pic')]);

            return view('divisi.dataPengajuan', compact('dt_pengajuan'));
        }
    }

    public function showDataPengajuanSayaAtasan()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {

            $dt_pengajuan = DB::table('t_pengajuan')
                ->select('t_pengajuan.*', 't_unitbarang.nama_unit', 't_unitbarang.brand_unit', 't_unitbarang.tipe_unit', 't_approval.ket_approval')
                ->join('t_unitbarang', 't_pengajuan.id_unit', '=', 't_unitbarang.id_unit')
                ->join('t_approval', 't_pengajuan.no_token', '=', 't_approval.no_token')
                ->where('nik', session('id_pic'))
                ->get();

            return view('atasan.showDataPengajuanSayaAtasan', compact('dt_pengajuan'));
        }
    }

    public function showDataPengajuanSayaManager()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {

            $dt_pengajuan = DB::table('t_pengajuan')
                ->select('t_pengajuan.*', 't_unitbarang.nama_unit', 't_unitbarang.brand_unit', 't_unitbarang.tipe_unit', 't_approval.ket_approval')
                ->join('t_unitbarang', 't_pengajuan.id_unit', '=', 't_unitbarang.id_unit')
                ->join('t_approval', 't_pengajuan.no_token', '=', 't_approval.no_token')
                ->where('nik', session('id_pic'))
                ->get();

            return view('manager.showDataPengajuanSayaManager', compact('dt_pengajuan'));
        }
    }

    public function dataRequestIt()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $dt_pengajuan = DB::table('t_pengajuan')
                ->select('t_pengajuan.*', 't_unitbarang.nama_unit', 't_unitbarang.brand_unit', 't_unitbarang.tipe_unit', 't_user.nama_user')
                ->join('t_unitbarang', 't_pengajuan.id_unit', '=', 't_unitbarang.id_unit')
                ->join('t_user', 't_pengajuan.nik', '=', 't_user.nik')
                ->where('status_pengajuan', '=', '81')
                ->get();
            return view('it.dataRequestIt', compact('dt_pengajuan'));
        }
    }

    public function pengajuanUser(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            $update_at = new Controller();
            $date = date('Y-m-d');
            $dateT = date('ym');
            $dateTg = date('d');

            $rdm = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 5)), 0, 6);
            $test = DB::select('SELECT count(no_token) as a FROM t_pengajuan where no_token = ?', [$rdm]);
            if ($test[0]->a == 0) {
                $token = $dateT . $rdm . $dateTg;
            } else {
                $rdm1 = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 5)), 0, 6);
                $token = $dateT . $rdm1 . $dateTg;
            }

            // return $tkk;
            // $token = "STI-" . $dateT . $urutan;
            // dd($token);
            // simpan ke t_pengajuan
            // update status unit di t_unitbarang
            // pembuatan token di t_approval 
            // return $token;
            $db_pengajuan = DB::table('t_unitbarang')
                ->select('status_unit')
                ->WHERE('id_unit', $request->idUnit)
                ->get();
            // return $db_pengajuan[0]->status_unit;
            if ($db_pengajuan[0]->status_unit > 1) {
                alert()->info('Oops! Unit sedang tidak ready', 'Sorry.')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showFormPengajuan');
            } else {
                # code...

                $save_pengajuan = DB::table('t_pengajuan')
                    ->insert([
                        'nik' => $request->nik,
                        'activitas_pengajuan' => 1,
                        'id_unit' => $request->idUnit,
                        'tgl_pengajuan' => $date,
                        'ket_pengajuan' => $request->ketPengajuan,
                        'status_pengajuan' => 11,
                        'update_at' => $update_at->update_at(),
                        'update_by' => session('id_pic'),
                        'no_token' => $token,
                        'id_divisi' => session('id_divisi'),
                        'atasan' => $request->atasan
                    ]);
                $update_unit = DB::table('t_unitbarang')
                    ->where('id_unit', $request->idUnit)
                    ->update([
                        'status_unit' => 5,
                        'peminjam' => session('id_pic'),
                    ]);
                $save_approval = DB::table('t_approval')
                    ->insert([
                        'no_token' => $token,
                        'approval_atas' => 3,
                        'approval_it' => 3,
                        'ket_approval' => "",
                        'status_approval' => 11,
                        'update_at' => $update_at->update_at(),
                        'update_by' => session('id_pic'),
                    ]);
                $log_pengajuan = DB::insert('INSERT INTO log_pengajuan SELECT * FROM t_pengajuan WHERE no_token = ?', [$token]);
                alert()->success('Your Request as Been Sent', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showDataPengajuanSaya');
            }
        }
    }

    public function pengajuanAtasan(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            $update_at = new Controller();
            $date = date('Y-m-d');
            $dateT = date('ym');
            $dateTg = date('d');

            $rdm = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 5)), 0, 6);
            $test = DB::select('SELECT count(no_token) as a FROM t_pengajuan where no_token = ?', [$rdm]);
            if ($test[0]->a == 0) {
                $token = $dateT . $rdm . $dateTg;
            } else {
                $rdm1 = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 5)), 0, 6);
                $token = $dateT . $rdm1 . $dateTg;
            }


            // simpan ke t_pengajuan
            // update status unit di t_unitbarang
            // pembuatan token di t_approval
            // return $token;
            $db_pengajuan = DB::table('t_unitbarang')
                ->select('status_unit')
                ->WHERE('id_unit', $request->idUnit)
                ->get();
            if ($db_pengajuan[0]->status_unit > 1) {
                alert()->info('Oops! Unit sedang tidak ready', 'Sorry.')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showFormPengajuanAtasan');
            } else {
                $save_pengajuan = DB::table('t_pengajuan')
                    ->insert([
                        'nik' => $request->nik,
                        'activitas_pengajuan' => 1,
                        'id_unit' => $request->idUnit,
                        'tgl_pengajuan' => $date,
                        'ket_pengajuan' => $request->ketPengajuan,
                        'status_pengajuan' => 21,
                        'update_at' => $update_at->update_at(),
                        'update_by' => session('id_pic'),
                        'no_token' => $token,
                        'id_divisi' => session('id_divisi'),
                    ]);
                $update_unit = DB::table('t_unitbarang')
                    ->where('id_unit', $request->idUnit)
                    ->update([
                        'status_unit' => 5,
                        'peminjam' => session('id_pic'),

                    ]);
                $save_approval = DB::table('t_approval')
                    ->insert([
                        'no_token' => $token,
                        'approval_atas' => 3,
                        'approval_it' => 3,
                        'ket_approval' => "",
                        'status_approval' => 21,
                        'update_at' => $update_at->update_at(),
                        'update_by' => session('id_pic'),
                    ]);
                $log_pengajuan = DB::insert('INSERT INTO log_pengajuan SELECT * FROM t_pengajuan WHERE no_token = ?', [$token]);
                alert()->success('Your Request as Been Sent', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showDataPengajuanSayaAtasan');
            }
        }
    }

    public function pengajuanManager(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            $update_at = new Controller();
            $date = date('Y-m-d');
            $dateT = date('ym');
            $dateTg = date('d');

            $rdm = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 5)), 0, 6);
            $test = DB::select('SELECT count(no_token) as a FROM t_pengajuan where no_token = ?', [$rdm]);
            if ($test[0]->a == 0) {
                $token = $dateT . $rdm . $dateTg;
            } else {
                $rdm1 = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 5)), 0, 6);
                $token = $dateT . $rdm1 . $dateTg;
            }


            // simpan ke t_pengajuan
            // update status unit di t_unitbarang
            // pembuatan token di t_approval
            // return $token;
            $db_pengajuan = DB::table('t_unitbarang')
                ->select('status_unit')
                ->WHERE('id_unit', $request->idUnit)
                ->get();
            if ($db_pengajuan[0]->status_unit > 1) {
                alert()->info('Oops! Unit sedang tidak ready', 'Sorry.')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showFormPengajuanManager ');
            } else {
                $save_pengajuan = DB::table('t_pengajuan')
                    ->insert([
                        'nik' => $request->nik,
                        'activitas_pengajuan' => 1,
                        'id_unit' => $request->idUnit,
                        'tgl_pengajuan' => $date,
                        'ket_pengajuan' => $request->ketPengajuan,
                        'status_pengajuan' => 11,
                        'update_at' => $update_at->update_at(),
                        'update_by' => session('id_pic'),
                        'no_token' => $token,
                        'id_divisi' => session('id_divisi'),
                        'atasan' => $request->atasan,
                    ]);
                $update_unit = DB::table('t_unitbarang')
                    ->where('id_unit', $request->idUnit)
                    ->update([
                        'status_unit' => 5,
                        'peminjam' => session('id_pic'),

                    ]);
                $save_approval = DB::table('t_approval')
                    ->insert([
                        'no_token' => $token,
                        'approval_atas' => 3,
                        'approval_it' => 3,
                        'ket_approval' => "",
                        'status_approval' => 11,
                        'update_at' => $update_at->update_at(),
                        'update_by' => session('id_pic'),
                    ]);
                $log_pengajuan = DB::insert('INSERT INTO log_pengajuan SELECT * FROM t_pengajuan WHERE no_token = ?', [$token]);
                alert()->success('Your Request as Been Sent', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showDataPengajuanSayaManager');
            }
        }
    }

    public function dataWaitAccAtasan()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $dt_pengajuan = DB::table('t_pengajuan')
                ->select('t_pengajuan.*', 't_unitbarang.nama_unit', 't_unitbarang.brand_unit', 't_unitbarang.tipe_unit', 't_user.nama_user')
                ->join('t_unitbarang', 't_pengajuan.id_unit', '=', 't_unitbarang.id_unit')
                ->join('t_user', 't_user.nik', '=', 't_pengajuan.nik')
                ->where('t_pengajuan.id_divisi', session('id_divisi'))
                ->where('t_pengajuan.status_pengajuan', 11)
                ->where('t_pengajuan.atasan', session('id_pic'))
                ->get();
            // return session('id_divisi');

            // dd($dt_pengajuan);

            return view('atasan.reqApprv', compact('dt_pengajuan'));
        }
    }

    public function dataWaitAccManager()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $dt_pengajuan = DB::table('t_pengajuan')
                ->select('t_pengajuan.*', 't_unitbarang.nama_unit', 't_unitbarang.brand_unit', 't_unitbarang.tipe_unit', 't_user.nama_user')
                ->join('t_unitbarang', 't_pengajuan.id_unit', '=', 't_unitbarang.id_unit')
                ->join('t_user', 't_user.nik', '=', 't_pengajuan.nik')
                ->where('t_pengajuan.id_divisi', session('id_divisi'))
                ->where('t_pengajuan.status_pengajuan', 11)
                ->where('t_pengajuan.atasan', session('id_pic'))
                ->get();
            // return session('id_divisi');

            // dd($dt_pengajuan);

            return view('manager.reqApprv', compact('dt_pengajuan'));
        }
    }

    public function dataPengajuanDivisi()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $dt_pengajuan = DB::table('t_pengajuan')
                ->select('t_pengajuan.*', 't_unitbarang.nama_unit', 't_approval.ket_approval', 't_unitbarang.brand_unit', 't_unitbarang.tipe_unit', 't_user.nama_user')
                ->join('t_unitbarang', 't_pengajuan.id_unit', '=', 't_unitbarang.id_unit')
                ->join('t_user', 't_user.nik', '=', 't_pengajuan.nik')
                ->join('t_approval', 't_approval.no_token', '=', 't_pengajuan.no_token')
                ->where('t_pengajuan.id_divisi', session('id_divisi'))
                ->get();
            // return session('id_divisi');

            // dd($dt_pengajuan);

            return view('atasan.pengajuanDivisi', compact('dt_pengajuan'));
        }
    }

    public function dataPengajuanDivisiManager()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $dt_pengajuan = DB::table('t_pengajuan')
                ->select('t_pengajuan.*', 't_unitbarang.nama_unit', 't_approval.ket_approval', 't_unitbarang.brand_unit', 't_unitbarang.tipe_unit', 't_user.nama_user')
                ->join('t_unitbarang', 't_pengajuan.id_unit', '=', 't_unitbarang.id_unit')
                ->join('t_user', 't_user.nik', '=', 't_pengajuan.nik')
                ->join('t_approval', 't_approval.no_token', '=', 't_pengajuan.no_token')
                ->where('t_pengajuan.id_divisi', session('id_divisi'))
                ->get();
            // return session('id_divisi');

            // dd($dt_pengajuan);

            return view('manager.pengajuanUserDivisi', compact('dt_pengajuan'));
        }
    }

    public function dataPengajuanAccAtasan()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $dt_pengajuan = DB::table('t_pengajuan')
                ->select('t_pengajuan.*', 't_unitbarang.nama_unit', 't_unitbarang.brand_unit', 't_unitbarang.tipe_unit', 't_user.nama_user', 'r_divisi.nama_divisi')
                ->join('t_unitbarang', 't_pengajuan.id_unit', '=', 't_unitbarang.id_unit')
                ->join('t_user', 't_user.nik', '=', 't_pengajuan.nik')
                ->join('r_divisi', 't_pengajuan.id_divisi', '=', 'r_divisi.id_divisi')
                ->where('t_pengajuan.status_pengajuan', 21)
                ->get();

            $dt_pic = DB::table('t_user')
                ->select('t_user.nik', 't_user.nama_user')
                ->where('id_divisi', 1)
                ->where('role', 4)
                ->get();
            // return session('id_divisi');

            // dd($dt_pengajuan);

            return view('it.reqApprvItSupport', compact('dt_pengajuan', 'dt_pic'));
        }
    }

    public function dataPengajuanAccIt()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $dt_pengajuan = DB::table('t_pengajuan')
                ->select('t_pengajuan.*', 't_unitbarang.nama_unit', 't_unitbarang.brand_unit', 't_unitbarang.tipe_unit', 't_user.nama_user', 'r_divisi.nama_divisi')
                ->join('t_unitbarang', 't_pengajuan.id_unit', '=', 't_unitbarang.id_unit')
                ->join('t_user', 't_user.nik', '=', 't_pengajuan.nik')
                ->join('r_divisi', 't_pengajuan.id_divisi', '=', 'r_divisi.id_divisi')
                ->where('t_pengajuan.status_pengajuan', 31)
                ->get();

            $dt_pic = DB::table('t_user')
                ->select('t_user.nik', 't_user.nama_user')
                ->where('id_divisi', 1)
                ->where('role', 4)
                ->get();
            // return session('id_divisi');

            // dd($dt_pengajuan);

            return view('admin_it.reqApprvIt', compact('dt_pengajuan', 'dt_pic'));
        }
    }

    public function allDataPengajuan()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $dt_pengajuan = DB::table('t_pengajuan')
                ->select('t_pengajuan.*', 't_unitbarang.nama_unit', 't_approval.ket_approval', 't_unitbarang.brand_unit', 't_unitbarang.tipe_unit', 't_user.nama_user', 'r_divisi.nama_divisi')
                ->join('t_unitbarang', 't_pengajuan.id_unit', '=', 't_unitbarang.id_unit')
                ->join('t_user', 't_user.nik', '=', 't_pengajuan.nik')
                ->join('r_divisi', 't_pengajuan.id_divisi', '=', 'r_divisi.id_divisi')
                ->join('t_approval', 't_approval.no_token', '=', 't_pengajuan.no_token')
                ->get();
            // return session('id_divisi');

            // dd($dt_pengajuan);

            return view('admin_it.allDataPengajuan', compact('dt_pengajuan'));
        }
    }

    public function hasilPengajuanAtasan(Request $request, $id, $token, $id_unit)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $update_at = new Controller();

            if ($id == 1) {
                $acc = DB::table('t_approval')
                    ->where('no_token', $token)
                    ->update([
                        'approval_atas' => 1,
                        'status_approval' => 21,
                        'update_at' => $update_at->update_at(),
                        'update_by' => session('id_pic'),
                    ]);

                $accc = DB::table('t_pengajuan')
                    ->where('no_token', $token)
                    ->update([
                        'status_pengajuan' => 21,
                    ]);
                $log_pengajuan = DB::insert('INSERT INTO log_pengajuan SELECT * FROM t_pengajuan WHERE no_token = ?', [$token]);
                alert()->success('Request Successfully Approved', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
            } elseif ($id == 9) {
                $reject = DB::table('t_approval')
                    ->where('no_token', $token)
                    ->update([
                        'approval_atas' => 9,
                        'status_approval' => 29,
                        'update_at' => $update_at->update_at(),
                        'update_by' => session('id_pic'),
                        'ket_approval' => $request->ketReject,
                    ]);
                $rejectt = DB::table('t_pengajuan')
                    ->where('no_token', $token)
                    ->update([
                        'status_pengajuan' => 29,
                    ]);

                $stok_unit = DB::table('t_unitbarang')
                    ->where('id_unit', $id_unit)
                    ->update([
                        'status_unit' => 1,
                    ]);
                $log_pengajuan = DB::insert('INSERT INTO log_pengajuan SELECT * FROM t_pengajuan WHERE no_token = ?', [$token]);
                alert()->info('Request as Been Rejected', 'info')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
            }
            return redirect('dataWaitAccAtasan');
        }
    }

    public function hasilPengajuanAtasanManager(Request $request, $id, $token, $id_unit)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $update_at = new Controller();

            if ($id == 1) {
                $acc = DB::table('t_approval')
                    ->where('no_token', $token)
                    ->update([
                        'approval_atas' => 1,
                        'status_approval' => 21,
                        'update_at' => $update_at->update_at(),
                        'update_by' => session('id_pic'),
                    ]);

                $accc = DB::table('t_pengajuan')
                    ->where('no_token', $token)
                    ->update([
                        'status_pengajuan' => 21,
                    ]);
                $log_pengajuan = DB::insert('INSERT INTO log_pengajuan SELECT * FROM t_pengajuan WHERE no_token = ?', [$token]);
                alert()->success('Request Successfully Approved', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
            } elseif ($id == 9) {
                $reject = DB::table('t_approval')
                    ->where('no_token', $token)
                    ->update([
                        'approval_atas' => 9,
                        'status_approval' => 29,
                        'update_at' => $update_at->update_at(),
                        'update_by' => session('id_pic'),
                        'ket_approval' => $request->ketReject,
                    ]);
                $rejectt = DB::table('t_pengajuan')
                    ->where('no_token', $token)
                    ->update([
                        'status_pengajuan' => 29,
                    ]);

                $stok_unit = DB::table('t_unitbarang')
                    ->where('id_unit', $id_unit)
                    ->update([
                        'status_unit' => 1,
                    ]);
                $log_pengajuan = DB::insert('INSERT INTO log_pengajuan SELECT * FROM t_pengajuan WHERE no_token = ?', [$token]);
                alert()->info('Request as Been Rejected', 'info')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
            }
            return redirect('dataWaitAccManager');
        }
    }

    public function hasilPengajuanIt(Request $request, $id, $token, $id_unit)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            $update_at = new Controller();

            if ($id == 1) {
                $acc = DB::table('t_approval')
                    ->where('no_token', $token)
                    ->update([
                        'approval_it' => 1,
                        'status_approval' => 31,
                        'update_at' => $update_at->update_at(),
                        'update_by' => session('id_pic'),

                    ]);

                $accc = DB::table('t_pengajuan')
                    ->where('no_token', $token)
                    ->update([
                        'status_pengajuan' => 31,


                    ]);

                $acccc = DB::table('t_unitbarang')
                    ->where('id_unit', $id_unit)
                    ->update([
                        'pic_unit' => $request->picUnit,
                    ]);

                $log_pengajuan = DB::insert('INSERT INTO log_pengajuan SELECT * FROM t_pengajuan WHERE no_token = ?', [$token]);
                alert()->success('Request Successfully Approved', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
            } elseif ($id == 9) {
                $sql = DB::table('t_approval')
                    ->where('no_token', $token)
                    ->update([
                        'approval_it' => 9,
                        'status_approval' => 39,
                        'update_at' => $update_at->update_at(),
                        'update_by' => session('id_pic'),
                        'ket_approval' => $request->ketReject,
                    ]);
                $sqll = DB::table('t_pengajuan')
                    ->where('no_token', $token)
                    ->update([
                        'status_pengajuan' => 39,
                    ]);

                $sqlll = DB::table('t_unitbarang')
                    ->where('id_unit', $id_unit)
                    ->update([
                        'status_unit' => 1,
                    ]);
                $log_pengajuan = DB::insert('INSERT INTO log_pengajuan SELECT * FROM t_pengajuan WHERE no_token = ?', [$token]);
                alert()->info('Request as Been Rejected', 'info')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
            }
            return redirect('dataPengajuanAccAtasan');
        }
    }

    public function hasilPengajuanAdminIt(Request $request, $id, $token, $id_unit)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            $update_at = new Controller();

            if ($id == 1) {
                $acc = DB::table('t_approval')
                    ->where('no_token', $token)
                    ->update([
                        'approval_it' => 1,
                        'status_approval' => 81,
                        'update_at' => $update_at->update_at(),
                        'update_by' => session('id_pic'),
                        'pic_unit' => $request->picUnit,

                    ]);

                $accc = DB::table('t_pengajuan')
                    ->where('no_token', $token)
                    ->update([
                        'status_pengajuan' => 81,
                        'pic_unit' => $request->picUnit,


                    ]);

                $acccc = DB::table('t_unitbarang')
                    ->where('id_unit', $id_unit)
                    ->update([
                        'pic_unit' => $request->picUnit,
                    ]);

                $log_pengajuan = DB::insert('INSERT INTO log_pengajuan SELECT * FROM t_pengajuan WHERE no_token = ?', [$token]);
                alert()->success('Request Successfully Approved', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
            } elseif ($id == 9) {
                $sql = DB::table('t_approval')
                    ->where('no_token', $token)
                    ->update([
                        'approval_it' => 9,
                        'status_approval' => 89,
                        'update_at' => $update_at->update_at(),
                        'update_by' => session('id_pic'),
                        'ket_approval' => $request->ketReject,
                    ]);
                $sqll = DB::table('t_pengajuan')
                    ->where('no_token', $token)
                    ->update([
                        'status_pengajuan' => 89,
                    ]);

                $sqlll = DB::table('t_unitbarang')
                    ->where('id_unit', $id_unit)
                    ->update([
                        'status_unit' => 1,
                    ]);
                $log_pengajuan = DB::insert('INSERT INTO log_pengajuan SELECT * FROM t_pengajuan WHERE no_token = ?', [$token]);
                alert()->info('Request as Been Rejected', 'info')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
            }
            return redirect('dataPengajuanAccIt');
        }
    }

    public function showAllProgres()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $dt_pengajuan = DB::table('t_pengajuan')
                ->select('t_pengajuan.*', 't_unitbarang.nama_unit', 't_unitbarang.brand_unit', 't_unitbarang.tipe_unit', 't_user.nama_user', 'r_divisi.nama_divisi')
                ->join('t_unitbarang', 't_pengajuan.id_unit', '=', 't_unitbarang.id_unit')
                ->join('t_user', 't_user.nik', '=', 't_pengajuan.nik')
                ->join('r_divisi', 't_pengajuan.id_divisi', '=', 'r_divisi.id_divisi')
                ->where('t_pengajuan.status_pengajuan', 41)
                ->get();

            return view('it.dataProgresIt', compact('dt_pengajuan'));
        }
    }

    public function dataProgressIt($token, $id_unit)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $update_at = new Controller();

            $acc = DB::table('t_approval')
                ->where('no_token', $token)
                ->update([
                    'status_approval' => 41,
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                    'pic_unit' => session('id_pic'),
                ]);

            $accc = DB::table('t_pengajuan')
                ->where('no_token', $token)
                ->update([
                    'status_pengajuan' => 41,
                    'pic_unit' => session('id_pic'),
                    'update_by' => session('id_pic'),
                    'update_at' => $update_at->update_at(),

                ]);

            $acccc = DB::table('t_unitbarang')
                ->where('id_unit', $id_unit)
                ->update([
                    'pic_unit' => session('id_pic'),
                    'update_by' => session('id_pic'),
                    'update_at' => $update_at->update_at(),

                ]);

            $log_pengajuan = DB::insert('INSERT INTO log_pengajuan SELECT * FROM t_pengajuan WHERE no_token = ?', [$token]);

            alert()->success('Progress Successfully Approved', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');

            return redirect('dataRequestIt');
        }
    }

    public function ProgresSelesaiIt(Request $request, $token, $id_unit)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $update_at = new Controller();

            $acc = DB::table('t_approval')
                ->where('no_token', $token)
                ->update([
                    'status_approval' => 91,
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                    'pic_unit' => session('id_pic'),
                ]);

            $accc = DB::table('t_pengajuan')
                ->where('no_token', $token)
                ->update([
                    'status_pengajuan' => 91,
                    'pic_unit' => session('id_pic'),
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),

                ]);

            $acccc = DB::table('t_unitbarang')
                ->where('id_unit', $id_unit)
                ->update([
                    'pic_unit' => session('id_pic'),
                    'ket_unit' => $request->keterangan,
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                ]);
            // return $token;

            $log_pengajuan = DB::insert('INSERT INTO log_pengajuan SELECT * FROM t_pengajuan WHERE no_token = ?', [$token]);
            alert()->success('Request Successfully Approved', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');

            return redirect('showAllProgres');
        }
    }

    public function Admlog_pengajuan()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $dt_pengajuan = DB::table('log_pengajuan')
                ->select('log_pengajuan.*', 't_unitbarang.nama_unit',  't_unitbarang.brand_unit', 't_unitbarang.tipe_unit', 't_user.nama_user', 'r_divisi.nama_divisi')
                // ->select('*')
                ->join('t_unitbarang', 'log_pengajuan.id_unit', '=', 't_unitbarang.id_unit')
                ->join('t_user', 't_user.nik', '=', 'log_pengajuan.nik')
                ->join('r_divisi', 'log_pengajuan.id_divisi', '=', 'r_divisi.id_divisi')
                // ->join('t_approval', 't_approval.no_token', '=', 'log_pengajuan.no_token')
                ->get();
            // return session('id_divisi');

            // $dt_pengajuan = DB::table('log_pengajuan')
            //     ->select('*')
            //     ->get();

            // dd($dt_pengajuan);

            return view('admin_it.log_pengajuan', compact('dt_pengajuan'));
        }
    }

    public function Admlog_kembali()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $dt_pengajuan = DB::table('log_kembali')
                ->select('log_kembali.*', 't_unitbarang.nama_unit',  't_unitbarang.brand_unit', 't_unitbarang.tipe_unit', 't_user.nama_user', 'r_divisi.nama_divisi')
                // ->select('*')
                ->join('t_unitbarang', 'log_kembali.id_unit', '=', 't_unitbarang.id_unit')
                ->join('t_user', 't_user.nik', '=', 'log_kembali.nik')
                ->join('r_divisi', 'log_kembali.id_divisi', '=', 'r_divisi.id_divisi')
                // ->join('t_approval', 't_approval.no_token', '=', 'log_pengajuan.no_token')
                ->get();
            // return session('id_divisi');

            // $dt_pengajuan = DB::table('log_pengajuan')
            //     ->select('*')
            //     ->get();

            // dd($dt_pengajuan);

            return view('admin_it.log_kembali', compact('dt_pengajuan'));
        }
    }
}
