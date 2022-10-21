<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PengembalianController extends Controller
{



    public function showAllProgresPengembalian()
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
                ->Where('t_pengajuan.status_pengajuan', 94)
                ->get();

            return view('it.dataProgresItPengembalian', compact('dt_pengajuan'));
        }
    }

    public function dataProgressPengembalianIt($token, $id_unit)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $update_at = new Controller();

            $acc = DB::table('t_approval')
                ->where('no_token', $token)
                ->update([
                    'status_approval' => 94,
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                    'pic_unit' => session('id_pic'),
                ]);

            $accc = DB::table('t_pengajuan')
                ->where('no_token', $token)
                ->update([
                    'status_pengajuan' => 94,
                    'update_by' => session('id_pic'),
                    'update_at' => $update_at->update_at(),
                    'pic_unit' => session('id_pic'),

                ]);

            $acccc = DB::table('t_unitbarang')
                ->where('id_unit', $id_unit)
                ->update([
                    'pic_unit' => session('id_pic'),
                    'update_by' => session('id_pic'),
                    'update_at' => $update_at->update_at(),
                ]);

            $log_pengembalian = DB::select('INSERT INTO log_kembali SELECT * FROM t_pengajuan WHERE no_token = ?', [$token]);

            alert()->success('Progress Successfully Finished', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');

            return redirect('dataRequestPengembalianIt');
        }
    }

    public function dataUnitPengembalian(Request $request)
    {
        $data = DB::table('t_pengajuan')
            ->select('t_pengajuan.tgl_pengajuan', 't_pengajuan.ket_pengajuan', 't_user.nama_user')
            ->join('t_user', 't_user.nik', 't_pengajuan.pic_unit')
            ->where('t_pengajuan.id_pengajuan', $request->id)
            ->get();
        return response()->json($data);
    }

    public function dataRequestPengembalianIt()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $dt_pengajuan = DB::table('t_pengajuan')
                ->select('t_pengajuan.*', 't_unitbarang.nama_unit', 't_unitbarang.brand_unit', 't_unitbarang.tipe_unit', 't_user.nama_user')
                ->join('t_unitbarang', 't_pengajuan.id_unit', '=', 't_unitbarang.id_unit')
                ->join('t_user', 't_pengajuan.nik', '=', 't_user.nik')
                ->where('status_pengajuan', '=', '93')
                ->get();
            return view('it.dataRequestPengembalianIt', compact('dt_pengajuan'));
        }
    }

    public function showFormPengembalian()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $dt_pinjaman = DB::table('t_pengajuan')
                ->select('*')
                ->join('t_unitbarang', 't_unitbarang.id_unit', 't_pengajuan.id_unit')
                ->where('t_pengajuan.nik', session('id_pic'))
                ->where('t_pengajuan.status_pengajuan', '=', '91')
                ->get();
            return view('divisi.formPengembalian', compact('dt_pinjaman'));
        }
    }

    public function showFormPengembalianAtasan()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $dt_pinjaman = DB::table('t_pengajuan')
                ->select('*')
                ->join('t_unitbarang', 't_unitbarang.id_unit', 't_pengajuan.id_unit')
                ->where('t_pengajuan.nik', session('id_pic'))
                ->where('t_pengajuan.status_pengajuan', '=', '91')
                ->get();
            return view('atasan.formPengembalian', compact('dt_pinjaman'));
        }
    }

    public function showFormPengembalianManager()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $dt_pinjaman = DB::table('t_pengajuan')
                ->select('*')
                ->join('t_unitbarang', 't_unitbarang.id_unit', 't_pengajuan.id_unit')
                ->where('t_pengajuan.nik', session('id_pic'))
                ->where('t_pengajuan.status_pengajuan', '=', '91')
                ->get();
            return view('manager.formPengembalian', compact('dt_pinjaman'));
        }
    }

    public function pengembalianUser(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            $update_at = new Controller();

            // $log_pengajuan = DB::select('INSERT INTO log_pengajuan SELECT * FROM t_pengajuan WHERE id_pengajuan = ?', [$request->id_pengajuan]);

            $pengajuan = DB::table('t_pengajuan')
                ->where('id_pengajuan', $request->id_pengajuan)
                ->update([
                    'activitas_pengajuan' => 2,
                    'status_pengajuan' => 93,
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                ]);

            $approval = DB::table('t_approval')
                ->where('id_approval', $request->id_pengajuan)
                ->update([
                    'status_approval' => 93,
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                ]);
            $log_pengembalian = DB::select('INSERT INTO log_kembali SELECT * FROM t_pengajuan WHERE id_pengajuan = ?', [$request->id_pengajuan]);

            alert()->success('Your Request as Been Sent', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
            return redirect('showDataPengajuanSaya');
        }
    }

    public function pengembalianAtasan(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            // return $request->all();
            $update_at = new Controller();


            $pengajuan = DB::table('t_pengajuan')
                ->where('id_pengajuan', $request->id_pengajuan)
                ->update([
                    'activitas_pengajuan' => 2,
                    'status_pengajuan' => 93,
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                ]);

            $approval = DB::table('t_approval')
                ->where('id_approval', $request->id_pengajuan)
                ->update([
                    'status_approval' => 93,
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                ]);
            $log_pengajuan = DB::select('INSERT INTO log_pengajuan SELECT * FROM t_pengajuan WHERE id_pengajuan = ?', [$request->id_pengajuan]);

            alert()->success('Your Request as Been Sent', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
            return redirect('showDataPengajuanSayaAtasan');
        }
    }

    public function ProgresSelesaiItPengembalian(Request $request, $token, $id_unit)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $update_at = new Controller();
            $date = date('Y-m-d');
            $acc = DB::table('t_approval')
                ->where('id_approval', $token)
                ->update([
                    'status_approval' => 92,
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                    'pic_unit' => session('id_pic'),
                ]);

            $accc = DB::table('t_pengajuan')
                ->where('id_pengajuan', $token)
                ->update([
                    'status_pengajuan' => 92,
                    'pic_unit' => session('id_pic'),
                    'ket_kembali' => $request->keterangan,
                    'tgl_pengembalian' => $date,
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),

                ]);

            $acccc = DB::table('t_unitbarang')
                ->where('id_unit', $id_unit)
                ->update([
                    'pic_unit' => session('id_pic'),
                    'status_unit' => 1,
                    'ket_unit' => $request->keterangan,
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                ]);

            $log_pengembalian = DB::select('INSERT INTO log_kembali SELECT * FROM t_pengajuan WHERE id_pengajuan = ?', [$token]);


            alert()->success('Progress Successfully Finished', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');

            return redirect('showAllProgresPengembalian');
        }
    }
}
