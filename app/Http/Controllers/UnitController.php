<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class UnitController extends Controller
{
    public function dataUnitSaya()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $dataunit = DB::table('t_unitbarang')
                ->select('t_unitbarang.*', 'r_jenisbarang.nama_jnsBarang', 'r_statusunit.nama_statUnit', 't_user.nama_user')
                ->join('r_jenisbarang', 't_unitbarang.jenis_unit', '=', 'r_jenisbarang.id_jnsBarang')
                ->join('r_statusunit', 't_unitbarang.status_unit', '=', 'r_statusunit.id_statUnit')
                ->join('t_user', 't_unitbarang.update_by', '=', 't_user.nik')
                ->where('t_unitbarang.pic_unit', session('id_pic'))
                ->get();
            return view('it.dataUnitSaya', compact('dataunit'));
        }
    }

    public function dataAllUnit(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            $status = $request->statusselect;
            if ($status == null) {
                $dataunit =
                    DB::select('SELECT t_unitbarang.*, r_jenisbarang.nama_jnsBarang, r_statusunit.nama_statUnit, t_user.nama_user, (SELECT t_user.nama_user FROM t_user WHERE t_user.nik = t_unitbarang.peminjam) as nama_peminjam, (SELECT r_divisi.nama_divisi FROM r_divisi WHERE (SELECT t_user.id_divisi FROM t_user WHERE t_user.nik = t_unitbarang.peminjam) = r_divisi.id_divisi) as divisi_pinjam FROM t_unitbarang
JOIN r_jenisbarang ON t_unitbarang.jenis_unit = r_jenisbarang.id_jnsBarang
JOIN r_statusunit ON t_unitbarang.status_unit =  r_statusunit.id_statUnit
JOIN t_user ON t_unitbarang.update_by = t_user.nik
JOIN r_divisi ON t_user.id_divisi = r_divisi.id_divisi');
            } else {
                $dataunit =
                    DB::select('SELECT t_unitbarang.*, r_jenisbarang.nama_jnsBarang, r_statusunit.nama_statUnit, t_user.nama_user, (SELECT t_user.nama_user FROM t_user WHERE t_user.nik = t_unitbarang.peminjam) as nama_peminjam, (SELECT r_divisi.nama_divisi FROM r_divisi WHERE (SELECT t_user.id_divisi FROM t_user WHERE t_user.nik = t_unitbarang.peminjam) = r_divisi.id_divisi) as divisi_pinjam FROM t_unitbarang
JOIN r_jenisbarang ON t_unitbarang.jenis_unit = r_jenisbarang.id_jnsBarang
JOIN r_statusunit ON t_unitbarang.status_unit =  r_statusunit.id_statUnit
JOIN t_user ON t_unitbarang.update_by = t_user.nik
JOIN r_divisi ON t_user.id_divisi = r_divisi.id_divisi WHERE t_unitbarang.status_unit = ?', [$status]);
            }


            $status = DB::table('r_statusunit')
                ->select('*')
                ->get();
            return view('it.dataAllUnit', compact('dataunit', 'status'));
        }
    }

    public function dataUnitBarang()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $dataunit = DB::table('t_unitbarang')
                ->select('t_unitbarang.*', 'r_jenisbarang.nama_jnsBarang', 'r_statusunit.nama_statUnit', 't_user.nama_user')
                ->join('r_jenisbarang', 't_unitbarang.jenis_unit', '=', 'r_jenisbarang.id_jnsBarang')
                ->join('r_statusunit', 't_unitbarang.status_unit', '=', 'r_statusunit.id_statUnit')
                ->join('t_user', 't_unitbarang.update_by', '=', 't_user.nik')
                ->get();
            return view('admin_it.dataUnitBarang', compact('dataunit'));
        }
    }

    public function dataUnitBarangStatus(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            $status = $request->statusselect;
            if ($status == null) {
                $dataunit = DB::select('SELECT t_unitbarang.*, r_jenisbarang.nama_jnsBarang, r_statusunit.nama_statUnit, t_user.nama_user, (SELECT t_user.nama_user FROM t_user WHERE t_user.nik = t_unitbarang.peminjam) as nama_peminjam FROM t_unitbarang
JOIN r_jenisbarang ON t_unitbarang.jenis_unit = r_jenisbarang.id_jnsBarang
JOIN r_statusunit ON t_unitbarang.status_unit =  r_statusunit.id_statUnit
JOIN t_user ON t_unitbarang.update_by = t_user.nik');
            } else {
                $dataunit = DB::select('SELECT t_unitbarang.*, r_jenisbarang.nama_jnsBarang, r_statusunit.nama_statUnit, t_user.nama_user, (SELECT t_user.nama_user FROM t_user WHERE t_user.nik = t_unitbarang.peminjam) as nama_peminjam FROM t_unitbarang
JOIN r_jenisbarang ON t_unitbarang.jenis_unit = r_jenisbarang.id_jnsBarang
JOIN r_statusunit ON t_unitbarang.status_unit =  r_statusunit.id_statUnit
JOIN t_user ON t_unitbarang.update_by = t_user.nik WHERE t_unitbarang.status_unit = ?', [$status]);
            }


            $status = DB::table('r_statusunit')
                ->select('*')
                ->get();
            return view('admin_it.dataUnitBarangStatus', compact('dataunit', 'status'));
        }
    }

    public function dataAllUnitPeminjaman()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $dataunit = DB::table('t_pengajuan')
                ->select('t_pengajuan.*', 't_unitbarang.nama_unit', 't_unitbarang.status_unit', 't_unitbarang.brand_unit', 't_unitbarang.tipe_unit', 't_user.nik', 't_user.nama_user', 'r_statusunit.nama_statUnit', 'r_jenisbarang.nama_jnsBarang', 't_user.role')
                ->join('t_unitbarang', 't_pengajuan.id_unit', '=', 't_unitbarang.id_unit')
                ->join('t_user', 't_pengajuan.nik', '=', 't_user.nik')
                ->join('r_statusunit', 't_unitbarang.status_unit', '=', 'r_statusunit.id_statUnit')
                ->join('r_jenisbarang', 't_unitbarang.jenis_unit', '=', 'r_jenisbarang.id_jnsBarang')
                ->get();


            return view('it.dataAllUnitPeminjaman', compact('dataunit'));
        }
    }

    public function addDataUnit()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $jnsbrg = DB::table('r_jenisbarang')
                ->get();
            $statbrg = DB::table('r_statusunit')
                ->get();
            $user = DB::table('t_user')
                ->get();
            return view('it.addDataUnit', compact('jnsbrg', 'statbrg', 'user'));
        }
    }

    public function editDataUnit($id)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $dt_unit = DB::table('t_unitbarang')
                ->select('t_unitbarang.*', 'r_jenisbarang.nama_jnsBarang', 'r_statusunit.nama_statUnit')
                ->join('r_jenisbarang', 't_unitbarang.jenis_unit', '=', 'r_jenisbarang.id_jnsBarang')
                ->join('r_statusunit', 't_unitbarang.status_unit', '=', 'r_statusunit.id_statUnit')
                ->where('id_unit', $id)
                ->first();
            $jnsbrg = DB::table('r_jenisbarang')
                ->get();
            $statbrg = DB::table('r_statusunit')
                ->get();
            $user = DB::table('t_user')
                ->get();
            return view('it.editDataUnit', compact('dt_unit', 'jnsbrg', 'statbrg', 'user'));
        }
    }

    public function saveUnit(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            $validation = request()->validate([
                'nama_unit' => ['required'],
                'brand_unit' => ['required'],
                'tipe_unit' => ['required'],
                'tahun_unit' => 'required|min:4|max:4',
                'jenis_unit' => ['required'],
                'status_unit' => ['required'],
            ]);
            $update_at = new Controller();
            $date = date('Y-m-d');
            if ($validation) {
                $data = array(
                    'nama_unit' => $request->nama_unit,
                    'brand_unit' => $request->brand_unit,
                    'tipe_unit' => $request->tipe_unit,
                    'tahun_unit' => $request->tahun_unit,
                    'jenis_unit' => $request->jenis_unit,
                    'tgl_regis_unit' => $date,
                    'status_unit' => $request->status_unit,
                    'ket_unit' => $request->keterangan_unit,
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                    'peminjam' => $request->peminjam,
                    'pic_unit' => session('id_pic'),
                );
                DB::table('t_unitbarang')->insert($data);

                if ($request->status_unit == 5) {
                    // 
                    $idnit = DB::select('SELECT MAX(id_unit) as idid FROM t_unitbarang');
                    // 
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
                    // 
                    $iddiv = DB::select('SELECT id_divisi FROM t_user WHERE nik = ? ', [$request->peminjam]);

                    // 
                    $dt_pengajuan = array(
                        'nik' => $request->peminjam,
                        'activitas_pengajuan' => '1',
                        'id_unit' => $idnit[0]->idid,
                        'tgl_pengajuan' => $update_at->update_at(),
                        'ket_pengajuan' => $request->keterangan_unit,
                        'status_pengajuan' => '91',
                        'update_at' => $update_at->update_at(),
                        'update_by' => session('id_pic'),
                        'no_token' => $token,
                        'id_divisi' => $iddiv[0]->id_divisi,
                        'pic_unit' => session('id_pic'),

                    );

                    DB::table('t_pengajuan')->insert($dt_pengajuan);
                    // dd($dt_pengajuan);

                    $dt_approval = array(
                        'no_token' => $token,
                        'approval_atas' => '1',
                        'approval_it' => '1',
                        'ket_approval' => '',
                        'status_approval' => '91',
                        'update_at' => $update_at->update_at(),
                        'update_by' => session('id_pic'),
                        'pic_unit' => session('id_pic'),
                    );
                    // dd($dt_approval);

                    DB::table('t_approval')->insert($dt_approval);
                }


                DB::select('INSERT INTO log_unitbarang SELECT * FROM t_unitbarang WHERE t_unitbarang.id_unit = (SELECT MAX(id_unit) FROM t_unitbarang)');
                alert()->success('Data Saved', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('dataAllUnit');
            }
        }
    }



    public function editUnit(Request $request, $id)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();

            $validation = request()->validate([
                'nama_unit' => ['required'],
                'brand_unit' => ['required'],
                'tipe_unit' => ['required'],
                'tahun_unit' => ['required'],
                'jenis_unit' => ['required'],
                'status_unit' => ['required'],
            ]);

            if ($request->status_unit == "Dalam Peminjaman") {
                $status_unit = 5;
                $pinjam = $request->peminjam_id;
            } else {
                $status_unit = $request->status_unit;
                $pinjam = $request->peminjam;
            }


            $update_at = new Controller();
            $date = date('Y-m-d');
            if ($validation) {
                $data = array(
                    'nama_unit' => $request->nama_unit,
                    'brand_unit' => $request->brand_unit,
                    'tipe_unit' => $request->tipe_unit,
                    'tahun_unit' => $request->tahun_unit,
                    'jenis_unit' => $request->jenis_unit,
                    'tgl_regis_unit' => $date,
                    'status_unit' => $status_unit,
                    'ket_unit' => $request->keterangan_unit,
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                    'peminjam' => $pinjam,
                    'pic_unit' => session('id_pic'),
                );



                if ($request->status_unit == 5) {
                    // 
                    // $idnit = DB::select('SELECT MAX(id_unit) as idid FROM t_unitbarang');
                    // 
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
                    // 
                    $iddiv = DB::select('SELECT id_divisi FROM t_user WHERE nik = ? ', [$request->peminjam]);

                    // 
                    $dt_pengajuan = array(
                        'nik' => $request->peminjam,
                        'activitas_pengajuan' => '1',
                        'id_unit' => $id,
                        'tgl_pengajuan' => $update_at->update_at(),
                        'ket_pengajuan' => $request->keterangan_unit,
                        'status_pengajuan' => '91',
                        'update_at' => $update_at->update_at(),
                        'update_by' => session('id_pic'),
                        'no_token' => $token,
                        'id_divisi' => $iddiv[0]->id_divisi,
                        'pic_unit' => session('id_pic'),
                    );

                    DB::table('t_pengajuan')->insert($dt_pengajuan);
                    // dd($dt_pengajuan);

                    $dt_approval = array(
                        'no_token' => $token,
                        'approval_atas' => '1',
                        'approval_it' => '1',
                        'ket_approval' => '',
                        'status_approval' => '91',
                        'update_at' => $update_at->update_at(),
                        'update_by' => session('id_pic'),
                        'pic_unit' => session('id_pic'),
                    );
                    // dd($dt_approval);

                    DB::table('t_approval')->insert($dt_approval);
                }


                DB::table('t_unitbarang')->where('id_unit', $id)->update($data);
                DB::insert('INSERT INTO log_unitbarang SELECT * FROM t_unitbarang WHERE t_unitbarang.id_unit = ? ', [$id]);
                alert()->success('Data Saved', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('dataAllUnit');
            }
        }
    }

    public function editUnitt(Request $request, $id)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();

            $validation = request()->validate([
                'nama_unit' => ['required'],
                'brand_unit' => ['required'],
                'tipe_unit' => ['required'],
                'tahun_unit' => ['required'],
                'jenis_unit' => ['required'],
                'status_unit' => ['required'],
            ]);
            $update_at = new Controller();
            $date = date('Y-m-d');
            if ($validation) {
                $data = array(
                    'nama_unit' => $request->nama_unit,
                    'brand_unit' => $request->brand_unit,
                    'tipe_unit' => $request->tipe_unit,
                    'tahun_unit' => $request->tahun_unit,
                    'jenis_unit' => $request->jenis_unit,
                    'tgl_regis_unit' => $date,
                    'status_unit' => $request->status_unit,
                    'ket_unit' => $request->keterangan_unit,
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                    'peminjam' => $request->peminjam,
                    'pic_unit' => session('id_pic'),
                );

                DB::table('t_unitbarang')->where('id_unit', $id)->update($data);

                DB::insert('INSERT INTO log_unitbarang SELECT * FROM t_unitbarang WHERE t_unitbarang.id_unit = ? ', [$id]);
                alert()->success('Data Saved', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('dataAllUnit');
            }
        }
    }


    public function unitByID()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $unitData = DB::table('t_unitbarang')
                ->select('t_unitbarang.*', 'r_jenisbarang.nama_jnsBarang', 'r_statusunit.nama_statUnit', 't_user.nama_user')
                ->join('r_jenisbarang', 't_unitbarang.jenis_unit', '=', 'r_jenisbarang.id_jnsBarang')
                ->join('r_statusunit', 't_unitbarang.status_unit', '=', 'r_statusunit.id_statUnit')
                ->join('t_user', 't_unitbarang.update_by', '=', 't_user.nik')
                ->where('t_unitbarang.jenis_unit', request('id_unit'))
                ->where('t_unitbarang.pic_unit', session('id_pic'))
                ->get();
        }
    }
}
