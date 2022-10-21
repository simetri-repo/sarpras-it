<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class SupportController extends Controller
{
    public function home()
    {
        if (session('id_pic') == null) {
            // Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $data = DB::table('t_user')
                ->where('nik', session('id_pic'))
                ->first();
            if ($data->role == '1') {
                $year = date('Y');
                $bln = date('m');
                $bl1 = DB::select('SELECT count(*) as bl1 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 1]);
                $bl2 = DB::select('SELECT count(*) as bl2 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 2]);
                $bl3 = DB::select('SELECT count(*) as bl3 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 3]);
                $bl4 = DB::select('SELECT count(*) as bl4 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 4]);
                $bl5 = DB::select('SELECT count(*) as bl5 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 5]);
                $bl6 = DB::select('SELECT count(*) as bl6 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 6]);
                $bl7 = DB::select('SELECT count(*) as bl7 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 7]);
                $bl8 = DB::select('SELECT count(*) as bl8 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 8]);
                $bl9 = DB::select('SELECT count(*) as bl9 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 9]);
                $bl10 = DB::select('SELECT count(*) as bl10 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 10]);
                $bl11 = DB::select('SELECT count(*) as bl11 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 11]);
                $bl12 = DB::select('SELECT count(*) as bl12 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 12]);
                // return $bln;
                $bltot = DB::select('SELECT count(*) as totbl FROM t_pengajuan');

                $total = array(
                    $bl1, $bl2, $bl3, $bl4, $bl5, $bl6, $bl7, $bl8, $bl9, $bl10, $bl11, $bl12
                );
                if ($bln == '01') {
                    $warna = "chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '02') {
                    $warna = "chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '03') {
                    $warna = "chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '04') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '05') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '06') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '07') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '08') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '09') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '10') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey";
                } elseif ($bln == '11') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey";
                } elseif ($bln == '12') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange";
                }
                // return $warna;
                return view('admin.index', compact('total', 'warna', 'bltot', 'bln'));
            } elseif ($data->role == '3') {
                $year = date('Y');
                $bln = date('m');
                $bl1 = DB::select('SELECT count(*) as bl1 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 1]);
                $bl2 = DB::select('SELECT count(*) as bl2 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 2]);
                $bl3 = DB::select('SELECT count(*) as bl3 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 3]);
                $bl4 = DB::select('SELECT count(*) as bl4 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 4]);
                $bl5 = DB::select('SELECT count(*) as bl5 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 5]);
                $bl6 = DB::select('SELECT count(*) as bl6 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 6]);
                $bl7 = DB::select('SELECT count(*) as bl7 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 7]);
                $bl8 = DB::select('SELECT count(*) as bl8 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 8]);
                $bl9 = DB::select('SELECT count(*) as bl9 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 9]);
                $bl10 = DB::select('SELECT count(*) as bl10 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 10]);
                $bl11 = DB::select('SELECT count(*) as bl11 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 11]);
                $bl12 = DB::select('SELECT count(*) as bl12 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 12]);
                // return $bln;
                $bltot = DB::select('SELECT count(*) as totbl FROM t_pengajuan');

                $total = array(
                    $bl1, $bl2, $bl3, $bl4, $bl5, $bl6, $bl7, $bl8, $bl9, $bl10, $bl11, $bl12
                );
                if ($bln == '01') {
                    $warna = "chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '02') {
                    $warna = "chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '03') {
                    $warna = "chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '04') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '05') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '06') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '07') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '08') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '09') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '10') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey";
                } elseif ($bln == '11') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey";
                } elseif ($bln == '12') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange";
                }
                // return $warna;
                return view('admin_it.index', compact('total', 'warna', 'bltot', 'bln'));
                // return view('admin_it.index', compact('dataunit'));
            } elseif ($data->role == '4') {
                $year = date('Y');
                $bln = date('m');
                $bl1 = DB::select('SELECT count(*) as bl1 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 1]);
                $bl2 = DB::select('SELECT count(*) as bl2 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 2]);
                $bl3 = DB::select('SELECT count(*) as bl3 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 3]);
                $bl4 = DB::select('SELECT count(*) as bl4 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 4]);
                $bl5 = DB::select('SELECT count(*) as bl5 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 5]);
                $bl6 = DB::select('SELECT count(*) as bl6 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 6]);
                $bl7 = DB::select('SELECT count(*) as bl7 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 7]);
                $bl8 = DB::select('SELECT count(*) as bl8 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 8]);
                $bl9 = DB::select('SELECT count(*) as bl9 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 9]);
                $bl10 = DB::select('SELECT count(*) as bl10 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 10]);
                $bl11 = DB::select('SELECT count(*) as bl11 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 11]);
                $bl12 = DB::select('SELECT count(*) as bl12 FROM t_pengajuan WHERE Year(tgl_pengajuan) = ? AND MONTH(tgl_pengajuan) = ?', [$year, 12]);
                // return $bln;
                $bltot = DB::select('SELECT count(*) as totbl FROM t_pengajuan');

                $total = array(
                    $bl1, $bl2, $bl3, $bl4, $bl5, $bl6, $bl7, $bl8, $bl9, $bl10, $bl11, $bl12
                );
                if ($bln == '01') {
                    $warna = "chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '02') {
                    $warna = "chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '03') {
                    $warna = "chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '04') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '05') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '06') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '07') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '08') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '09') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey,chartColors.grey";
                } elseif ($bln == '10') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey,chartColors.grey";
                } elseif ($bln == '11') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange,chartColors.grey";
                } elseif ($bln == '12') {
                    $warna = "chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.grey,chartColors.info,chartColors.orange";
                }
                // return $warna;
                return view('it.index', compact('total', 'warna', 'bltot', 'bln'));
                // return view('it.index', compact('dataunit'));
            } elseif ($data->role == '5') {
                $dataunit = DB::table('t_unitbarang')
                    ->join('r_jenisbarang', 'r_jenisbarang.id_jnsBarang', '=', 't_unitbarang.jenis_unit')
                    ->where('status_unit', '1')
                    ->get();
                return view('atasan.index', compact('dataunit'));
            } elseif ($data->role == '6') {
                $dataunit = DB::table('t_unitbarang')
                    ->join('r_jenisbarang', 'r_jenisbarang.id_jnsBarang', '=', 't_unitbarang.jenis_unit')
                    ->where('status_unit', '1')
                    ->get();
                return view('divisi.index', compact('dataunit'));
            } elseif ($data->role == '7') {
                $dataunit = DB::table('t_unitbarang')
                    ->join('r_jenisbarang', 'r_jenisbarang.id_jnsBarang', '=', 't_unitbarang.jenis_unit')
                    ->where('status_unit', '1')
                    ->get();
                return view('manager.index', compact('dataunit'));
            }
        }
    }

    // DIVISI   
    public function showdivisi()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $data = DB::table('r_divisi')
                ->select('*')
                ->get();
            return view('admin.datadivisi', compact('data'));
        }
    }

    public function savedivisi(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $update_at = new Controller;
            $save = DB::table('r_divisi')
                ->insert([
                    'nama_divisi' => $request->divisi,
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                ]);
            // return $request->all();
            if ($save) {
                alert()->success('Saved Success', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showdivisi');
            } else {
                alert()->error('Something Wrong!', 'Oops!')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showdivisi');
            }
        }
    }

    public function deletedivisi($id)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $update_at = new Controller;
            $delete = DB::table('r_divisi')
                ->where('id_divisi', $id)
                ->delete();
            if ($delete) {
                alert()->warning('Data Deleted', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showdivisi');
            } else {
                alert()->error('Something Wrong!', 'Oops!')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showdivisi');
            }
        }
    }

    public function editdivisi($id, Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $update_at = new Controller;
            $data = DB::table('r_divisi')
                ->where('id_divisi', $id)
                ->update([
                    'nama_divisi' => $request->divisi_up,
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                ]);
            if ($data) {
                alert()->success('Data Saved', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showdivisi');
            } else {
                alert()->error('Something Wrong!', 'Oops!')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showdivisi');
            }

            // return $request->all();
        }
    }

    public function showAnggotaDivisi()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $data = DB::table('t_user')
                ->select('*')
                ->where('id_divisi', session('id_divisi'))
                ->get();
            return view('atasan.dataDivisi', compact('data'));
        }
    }

    public function showAnggotaDivisiManager()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $data = DB::table('t_user')
                ->select('*')
                ->where('id_divisi', session('id_divisi'))
                ->get();
            return view('manager.dataDivisi', compact('data'));
        }
    }
    // activitas   
    public function showactivitas()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $data = DB::table('r_activitas')
                ->select('*')
                ->get();
            return view('admin.dataactivitas', compact('data'));
        }
    }

    public function saveactivitas(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $update_at = new Controller;
            $save = DB::table('r_activitas')
                ->insert([
                    'nama_activitas' => $request->activitas,
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                ]);
            // return $request->all();
            if ($save) {
                alert()->success('Saved Success', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showactivitas');
            } else {
                alert()->error('Something Wrong!', 'Oops!')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showactivitas');
            }
        }
    }

    public function deleteactivitas($id)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $update_at = new Controller;
            $delete = DB::table('r_activitas')
                ->where('id_activitas', $id)
                ->delete();
            if ($delete) {
                alert()->warning('Data Deleted', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showactivitas');
            } else {
                alert()->error('Something Wrong!', 'Oops!')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showactivitas');
            }
        }
    }

    public function editactivitas($id, Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $update_at = new Controller;
            $data = DB::table('r_activitas')
                ->where('id_activitas', $id)
                ->update([
                    'nama_activitas' => $request->activitas_up,
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                ]);
            if ($data) {
                alert()->success('Data Saved', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showactivitas');
            } else {
                alert()->error('Something Wrong!', 'Oops!')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showactivitas');
            }

            // return $request->all();
        }
    }

    // jenisbarang   
    public function showjenisbarang()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $data = DB::table('r_jenisbarang')
                ->select('*')
                ->get();
            return view('admin.datajenisbarang', compact('data'));
        }
    }

    public function savejenisbarang(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $update_at = new Controller;
            $save = DB::table('r_jenisbarang')
                ->insert([
                    'nama_jnsBarang' => $request->jenisbarang,
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                ]);
            // return $request->all();
            if ($save) {
                alert()->success('Saved Success', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showjenisbarang');
            } else {
                alert()->error('Something Wrong!', 'Oops!')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showjenisbarang');
            }
        }
    }

    public function deletejenisbarang($id)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $update_at = new Controller;
            $delete = DB::table('r_jenisbarang')
                ->where('id_jnsBarang', $id)
                ->delete();
            if ($delete) {
                alert()->warning('Data Deleted', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showjenisbarang');
            } else {
                alert()->error('Something Wrong!', 'Oops!')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showjenisbarang');
            }
        }
    }

    public function editjenisbarang($id, Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $update_at = new Controller;
            $data = DB::table('r_jenisbarang')
                ->where('id_jnsBarang', $id)
                ->update([
                    'nama_jnsBarang' => $request->jenisbarang_up,
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                ]);
            if ($data) {
                alert()->success('Data Saved', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showjenisbarang');
            } else {
                alert()->error('Something Wrong!', 'Oops!')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showjenisbarang');
            }

            // return $request->all();
        }
    }

    // statusunit   
    public function showstatusunit()
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $data = DB::table('r_statusunit')
                ->select('*')
                ->get();
            return view('admin.datastatusunit', compact('data'));
        }
    }

    public function savestatusunit(Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $update_at = new Controller;
            $save = DB::table('r_statusunit')
                ->insert([
                    'nama_statUnit' => $request->statusunit,
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                ]);
            // return $request->all();
            if ($save) {
                alert()->success('Saved Success', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showstatusunit');
            } else {
                alert()->error('Something Wrong!', 'Oops!')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showstatusunit');
            }
        }
    }

    public function deletestatusunit($id)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $update_at = new Controller;
            $delete = DB::table('r_statusunit')
                ->where('id_statUnit', $id)
                ->delete();
            if ($delete) {
                alert()->warning('Data Deleted', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showstatusunit');
            } else {
                alert()->error('Something Wrong!', 'Oops!')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showstatusunit');
            }
        }
    }

    public function editstatusunit($id, Request $request)
    {
        if (session('id_pic') == null) {
            Alert::error('Oops!', 'Sesi Telah Berakhir, Silahkan Login Kembali!');
            return redirect('Logout');
        } else {
            $update_at = new Controller;
            $data = DB::table('r_statusunit')
                ->where('id_statUnit', $id)
                ->update([
                    'nama_statUnit' => $request->statusunit_up,
                    'update_at' => $update_at->update_at(),
                    'update_by' => session('id_pic'),
                ]);
            if ($data) {
                alert()->success('Data Saved', 'Successfully')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showstatusunit');
            } else {
                alert()->error('Something Wrong!', 'Oops!')->toToast()->timerProgressBar()->autoclose('3000')->position('top');
                return redirect('showstatusunit');
            }

            // return $request->all();
        }
    }
}
