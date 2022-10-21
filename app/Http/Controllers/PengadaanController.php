<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class PengadaanController extends Controller
{
    public function showDataPengadaanSaya()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {

            $dt_pengadaan = DB::table('t_pengadaan')
                ->select('*')
                ->where('t_pengadaan.pic_unit', session('id_pic'))
                ->get();

            return view('divisi.dataPengadaan', compact('dt_pengadaan'));
        }
    }

    public function showDataPengadaanSayaAtasan()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {

            $dt_pengadaan = DB::table('t_pengadaan')
                ->select('*')
                ->where('t_pengadaan.pic_unit', session('id_pic'))
                ->get();

            return view('atasan.dataPengadaanSaya', compact('dt_pengadaan'));
        }
    }

    public function showDataPengadaanDivisi()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {

            $dt_pengadaan = DB::table('t_pengadaan')
                ->select('*')
                ->join('t_user', 't_pengadaan.pic_unit', '=', 't_user.nik')
                ->where('t_pengadaan.id_divisi', session('id_divisi'))
                ->get();

            return view('atasan.dataPengadaan', compact('dt_pengadaan'));
        }
    }

    public function showDataPengadaanit()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {

            $dt_pengadaan = DB::table('t_pengadaan')
                ->select('*')
                ->join('t_user', 't_pengadaan.pic_unit', '=', 't_user.nik')
                ->join('r_divisi', 't_user.id_divisi', '=', 'r_divisi.id_divisi')
                ->get();
            if (session('role') == '4') {
                return view('it.dataPengadaan', compact('dt_pengadaan'));
            } elseif (session('role') == '3') {
                return view('admin_it.dataPengadaan', compact('dt_pengadaan'));
            }
        }
    }

    public function reqPengadaanDivisi()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {

            $dt_pengadaan = DB::table('t_pengadaan')
                ->select('*')
                ->join('t_user', 't_pengadaan.pic_unit', '=', 't_user.nik')
                ->where('t_pengadaan.id_divisi', session('id_divisi'))
                ->where('status_approval', '=', '71')
                ->get();

            return view('atasan.reqPengadaanDivisi', compact('dt_pengadaan'));
        }
    }

    public function reqPengadaanIt()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {

            $dt_pengadaan = DB::table('t_pengadaan')
                ->select('*')
                ->join('t_user', 't_pengadaan.pic_unit', '=', 't_user.nik')
                ->where('status_approval', '=', '72')
                ->get();

            return view('it.reqPengadaan', compact('dt_pengadaan'));
        }
    }

    public function reqPengadaanAdminIt()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {

            $dt_pengadaan = DB::table('t_pengadaan')
                ->select('*')
                ->join('t_user', 't_pengadaan.pic_unit', '=', 't_user.nik')
                ->join('r_divisi', 't_user.id_divisi', '=', 'r_divisi.id_divisi')
                ->where('status_approval', '=', '73')
                ->get();

            return view('admin_it.reqPengadaan', compact('dt_pengadaan'));
        }
    }

    public function ProgressPengadaanIt()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {

            $dt_pengadaan = DB::table('t_pengadaan')
                ->select('*')
                ->join('t_user', 't_pengadaan.pic_unit', '=', 't_user.nik')
                ->join('r_divisi', 't_user.id_divisi', '=', 'r_divisi.id_divisi')
                ->where('status_approval', '=', '74')
                ->get();

            return view('it.ProgressPengadaanIt', compact('dt_pengadaan'));
        }
    }

    public function ProgressPengadaanItAcc()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {

            $dt_pengadaan = DB::table('t_pengadaan')
                ->select('*')
                ->join('t_user', 't_pengadaan.pic_unit', '=', 't_user.nik')
                ->join('r_divisi', 't_user.id_divisi', '=', 'r_divisi.id_divisi')
                ->where('status_approval', '=', '75')
                ->get();

            return view('it.ProgressPengadaanItAcc', compact('dt_pengadaan'));
        }
    }

    public function showFormPengadaan()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $jnsbrg = DB::table('r_jenisbarang')
                ->get();
            return view('divisi.formPengadaan', compact('jnsbrg'));
        }
    }

    public function showFormPengadaanAtasan()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $jnsbrg = DB::table('r_jenisbarang')
                ->get();
            return view('atasan.formPengadaan', compact('jnsbrg'));
        }
    }

    public function saveUnitPengadaan(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            // $validation = request()->validate([
            //     'nama_unit' => ['required'],
            //     'brand_unit' => ['required'],
            //     'tipe_unit' => ['required'],
            //     'tahun_unit' => ['required'],
            //     'jenis_unit' => ['required'],
            //     'status_unit' => ['required'],
            // ]);
            $update_at = new Controller();
            $date = date('Y-m-d');
            // if ($validation) {
            $data = array(
                'nama_unit' => $request->nama_unit,
                'brand_unit' => $request->brand_unit,
                'tipe_unit' => $request->tipe_unit,
                'tahun_unit' => $request->tahun_unit,
                'jenis_unit' => $request->jenis_unit,
                'tgl_regis_unit' => $date,
                'status_unit' => '4',
                'pic_unit' => session('id_pic'),
                'ket_unit' => $request->keterangan_unit,
                'update_at' => $update_at->update_at(),
                'update_by' => session('id_pic'),
                'status_approval' => '71',
                'ket_approval' => '',
                'id_divisi' => session('id_divisi'),
            );
            DB::table('t_pengadaan')->insert($data);
            // DB::table('log_pengadaan')->insert($data);
            alert()->success('Request sent to atasan.', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
            return redirect('showDataPengadaanSaya');
            // }
        }
    }

    public function saveUnitPengadaanAtasan(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            // $validation = request()->validate([
            //     'nama_unit' => ['required'],
            //     'brand_unit' => ['required'],
            //     'tipe_unit' => ['required'],
            //     'tahun_unit' => ['required'],
            //     'jenis_unit' => ['required'],
            //     'status_unit' => ['required'],
            // ]);
            $update_at = new Controller();
            $date = date('Y-m-d');
            // if ($validation) {
            $data = array(
                'nama_unit' => $request->nama_unit,
                'brand_unit' => $request->brand_unit,
                'tipe_unit' => $request->tipe_unit,
                'tahun_unit' => $request->tahun_unit,
                'jenis_unit' => $request->jenis_unit,
                'tgl_regis_unit' => $date,
                'status_unit' => '4',
                'pic_unit' => session('id_pic'),
                'ket_unit' => $request->keterangan_unit,
                'update_at' => $update_at->update_at(),
                'update_by' => session('id_pic'),
                'status_approval' => '72',
                'ket_approval' => '',
                'id_divisi' => session('id_divisi'),
            );
            DB::table('t_pengadaan')->insert($data);
            // DB::table('log_pengadaan')->insert($data);
            alert()->success('Request sent to IT.', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
            return redirect('showDataPengadaanSayaAtasan');
            // }
        }
    }

    public function apprvPengadaanAtasan(Request $request, $acc, $id)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {

            $update_at = new Controller();
            if ($acc == '1') {
                $date = date('Y-m-d');
                $data = array(
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                    'status_approval' => '72',
                );
                DB::table('t_pengadaan')->where('id_unit', $id)->update($data);
                DB::insert('INSERT INTO log_pengadaan SELECT * FROM t_pengadaan WHERE t_pengadaan.id_unit = ?', [$id]);
                alert()->success('Request Successfully Approve.', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showDataPengadaanDivisi');
            } else {
                $date = date('Y-m-d');
                $data = array(
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                    'status_approval' => '77',
                    'ket_approval' => $request->ketReject
                );
                DB::table('t_pengadaan')->where('id_unit', $id)->update($data);
                DB::insert('INSERT INTO log_pengadaan SELECT * FROM t_pengadaan WHERE t_pengadaan.id_unit = ?', [$id]);
                alert()->info('Request Rejected.', 'Rejected')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showDataPengadaanDivisi');
            }

            // }
        }
    }

    public function apprvPengadaanIt(Request $request, $acc, $id)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {

            $update_at = new Controller();
            if ($acc == '1') {
                $date = date('Y-m-d');
                $data = array(
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                    'status_approval' => '73',
                );
                DB::table('t_pengadaan')->where('id_unit', $id)->update($data);
                DB::insert('INSERT INTO log_pengadaan SELECT * FROM t_pengadaan WHERE t_pengadaan.id_unit = ?', [$id]);
                alert()->success('Request Successfully Approve.', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('reqPengadaanIt');
            } else {
                $date = date('Y-m-d');
                $data = array(
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                    'status_approval' => '78',
                    'ket_approval' => $request->ketReject
                );
                DB::table('t_pengadaan')->where('id_unit', $id)->update($data);
                DB::insert('INSERT INTO log_pengadaan SELECT * FROM t_pengadaan WHERE t_pengadaan.id_unit = ?', [$id]);
                alert()->info('Request Rejected.', 'Rejected')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('reqPengadaanIt');
            }

            // }
        }
    }

    public function apprvPengadaanAdminIt(Request $request, $acc, $id)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {

            $update_at = new Controller();
            if ($acc == '1') {
                $date = date('Y-m-d');
                $data = array(
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                    'status_approval' => '74',
                );
                DB::table('t_pengadaan')->where('id_unit', $id)->update($data);
                DB::insert('INSERT INTO log_pengadaan SELECT * FROM t_pengadaan WHERE t_pengadaan.id_unit = ?', [$id]);
                alert()->success('Request Successfully Approv.', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('reqPengadaanAdminIt');
            } else {
                $date = date('Y-m-d');
                $data = array(
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                    'status_approval' => '79',
                    'ket_approval' => $request->ketReject
                );
                DB::table('t_pengadaan')->where('id_unit', $id)->update($data);
                DB::insert('INSERT INTO log_pengadaan SELECT * FROM t_pengadaan WHERE t_pengadaan.id_unit = ?', [$id]);
                alert()->info('Request Rejected.', 'Rejected')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('reqPengadaanAdminIt');
            }

            // }
        }
    }

    public function ApprvProgressPengadaanIt($id)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {

            $update_at = new Controller();
            $date = date('Y-m-d');
            $data = array(
                'update_at' => $update_at->update_at(),
                'update_by' => session('id_pic'),
                'status_approval' => '75',
            );
            DB::table('t_pengadaan')->where('id_unit', $id)->update($data);
            DB::insert('INSERT INTO log_pengadaan SELECT * FROM t_pengadaan WHERE t_pengadaan.id_unit = ?', [$id]);
            alert()->success('Request Successfully Approve.', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
            return redirect('ProgressPengadaanIt');


            // }
        }
    }

    public function ApprvProgressPengadaanItAcc($id)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {

            // update status pengadaan
            // simpan ke tabel barang
            // log

            $update_at = new Controller();
            $date = date('Y-m-d');
            $data = array(
                'update_at' => $update_at->update_at(),
                'update_by' => session('id_pic'),
                'status_approval' => '76',
            );

            DB::table('t_pengadaan')->where('id_unit', $id)->update($data);
            DB::insert('INSERT INTO t_unitbarang (nama_unit,brand_unit,tipe_unit,tahun_unit,jenis_unit,tgl_regis_unit,status_unit,pic_unit,ket_unit,update_at,update_by) 
                        SELECT nama_unit,brand_unit,tipe_unit,tahun_unit,jenis_unit,tgl_regis_unit,status_unit,pic_unit,ket_unit,update_at,update_by 
                        FROM t_pengadaan  WHERE t_pengadaan.id_unit = ?', [$id]);
            DB::insert('INSERT INTO log_pengadaan SELECT * FROM t_pengadaan WHERE t_pengadaan.id_unit = ?', [$id]);
            alert()->success('Request Successfully Approv, And Save to Unit Barang.', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
            return redirect('ProgressPengadaanIt');
        }
    }
}
