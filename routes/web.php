<?php

use App\Http\Controllers\LoginController;


use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengadaanController;
use App\Http\Controllers\PengajuanController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/Login', function () {
    return view('login');
});

Route::post('authLogin', [LoginController::class, 'authlogin']);
Route::get('Logout', [LoginController::class, 'authlogout']);

// home
Route::get('home', [SupportController::class, 'home']);

Route::get('/Token_gen', function () {
    return view('admin/generate-token');
});

Route::post('generate_token', [PengajuanController::class, 'generate_token']);



// Modul support

Route::get('showdivisi', [SupportController::class, 'showdivisi']);
Route::get('showAnggotaDivisi', [SupportController::class, 'showAnggotaDivisi']);
Route::post('savedivisi', [SupportController::class, 'savedivisi']);
Route::get('deletedivisi/{id}', [SupportController::class, 'deletedivisi']);
Route::post('editdivisi/{id}', [SupportController::class, 'editdivisi']);

// activitas
Route::get('showactivitas', [SupportController::class, 'showactivitas']);
Route::post('saveactivitas', [SupportController::class, 'saveactivitas']);
Route::get('deleteactivitas/{id}', [SupportController::class, 'deleteactivitas']);
Route::post('editactivitas/{id}', [SupportController::class, 'editactivitas']);

// jenisbarang
Route::get('showjenisbarang', [SupportController::class, 'showjenisbarang']);
Route::post('savejenisbarang', [SupportController::class, 'savejenisbarang']);
Route::get('deletejenisbarang/{id}', [SupportController::class, 'deletejenisbarang']);
Route::post('editjenisbarang/{id}', [SupportController::class, 'editjenisbarang']);

// statusunit
Route::get('showstatusunit', [SupportController::class, 'showstatusunit']);
Route::post('savestatusunit', [SupportController::class, 'savestatusunit']);
Route::get('deletestatusunit/{id}', [SupportController::class, 'deletestatusunit']);
Route::post('editstatusunit/{id}', [SupportController::class, 'editstatusunit']);




// Modul user

Route::get('showuser', [UserController::class, 'showuser']);
Route::get('showuserid/{id}', [UserController::class, 'showuserid']);
Route::post('saveuser', [UserController::class, 'saveuser']);
Route::post('edituser/{id}', [UserController::class, 'edituser']);
Route::get('myaccount', [UserController::class, 'myaccount']);
Route::get('resetpass/{nik}/{id}', [UserController::class, 'resetpass']);
Route::get('deleteuser/{id}', [UserController::class, 'deleteuser']);
Route::get('/v_nik', [UserController::class, 'v_nik']);
Route::get('/v_username', [UserController::class, 'v_username']);



// Modul Unit

Route::get('dataUnitSaya', [UnitController::class, 'dataUnitSaya']);
Route::get('dataUnitBarang', [UnitController::class, 'dataUnitBarang']);
Route::get('dataUnitBarangStatus', [UnitController::class, 'dataUnitBarangStatus']);
Route::post('dataUnitBarangStatus2', [UnitController::class, 'dataUnitBarangStatus']);
Route::get('dataAllUnit', [UnitController::class, 'dataAllUnit']);
Route::post('dataAllUnit2', [UnitController::class, 'dataAllUnit']);
Route::get('dataAllUnitPeminjaman', [UnitController::class, 'dataAllUnitPeminjaman']);
Route::get('AddDataUnit', [UnitController::class, 'AddDataUnit']);
Route::get('editDataUnit/{id}', [UnitController::class, 'editDataUnit']);
Route::post('editUnit/{id}', [UnitController::class, 'editUnit']);
Route::post('saveUnit', [UnitController::class, 'saveUnit']);




// Modul pengajuan

Route::get('showFormPengajuan', [PengajuanController::class, 'showFormPengajuan']);
Route::get('showDataPengajuan', [PengajuanController::class, 'showDataPengajuan']);
Route::get('showDataPengajuanSaya', [PengajuanController::class, 'showDataPengajuanSaya']);
Route::get('/dataUnitById', [PengajuanController::class, 'dataUnitById']);
Route::get('/dataUnitByIdPart', [PengajuanController::class, 'dataUnitByIdPart']);
Route::get('showFormPengajuanAtasan', [PengajuanController::class, 'showFormPengajuanAtasan']);
Route::get('dataRequestIt', [PengajuanController::class, 'dataRequestIt']);
Route::post('pengajuanUser', [PengajuanController::class, 'pengajuanUser']);
Route::post('pengajuanAtasan', [PengajuanController::class, 'pengajuanAtasan']);
Route::get('showDataPengajuanSayaAtasan', [PengajuanController::class, 'showDataPengajuanSayaAtasan']);
Route::get('dataWaitAccAtasan', [PengajuanController::class, 'dataWaitAccAtasan']);
Route::get('dataPengajuanDivisi', [PengajuanController::class, 'dataPengajuanDivisi']);
Route::post('hasilPengajuanAtasan/{id}/{token}/{id_unit}', [PengajuanController::class, 'hasilPengajuanAtasan']);
Route::get('dataPengajuanAccAtasan', [PengajuanController::class, 'dataPengajuanAccAtasan']);
Route::get('dataPengajuanAccIt', [PengajuanController::class, 'dataPengajuanAccIt']);
Route::get('allDataPengajuan', [PengajuanController::class, 'allDataPengajuan']);
Route::post('hasilPengajuanIt/{id}/{token}/{id_unit}', [PengajuanController::class, 'hasilPengajuanIt']);
Route::post('hasilPengajuanAdminIt/{id}/{token}/{id_unit}', [PengajuanController::class, 'hasilPengajuanAdminIt']);
Route::get('dataProgressIt/{token}/{id_unit}', [PengajuanController::class, 'dataProgressIt']);
Route::post('ProgresSelesaiIt/{token}/{id_unit}', [PengajuanController::class, 'ProgresSelesaiIt']);
Route::get('showAllProgres', [PengajuanController::class, 'showAllProgres']);
Route::get('Admlog_pengajuan', [PengajuanController::class, 'Admlog_pengajuan']);
Route::get('Admlog_kembali', [PengajuanController::class, 'Admlog_kembali']);




// Modul pengembalian

Route::post('pengembalianUser', [PengembalianController::class, 'pengembalianUser']);
Route::post('pengembalianAtasan', [PengembalianController::class, 'pengembalianAtasan']);
Route::get('/dataUnitPengembalian', [PengembalianController::class, 'dataUnitPengembalian']);
Route::get('showFormPengembalian', [PengembalianController::class, 'showFormPengembalian']);
Route::get('showFormPengembalianAtasan', [PengembalianController::class, 'showFormPengembalianAtasan']);
Route::get('showAllProgresPengembalian', [PengembalianController::class, 'showAllProgresPengembalian']);
Route::get('dataProgressPengembalianIt/{token}/{id_unit}', [PengembalianController::class, 'dataProgressPengembalianIt']);
Route::get('dataRequestPengembalianIt', [PengembalianController::class, 'dataRequestPengembalianIt']);
Route::post('ProgresSelesaiItPengembalian/{token}/{id_unit}', [PengembalianController::class, 'ProgresSelesaiItPengembalian']);


// manager
Route::get('dataWaitAccManager', [PengajuanController::class, 'dataWaitAccManager']);
Route::get('showFormPengajuanManager', [PengajuanController::class, 'showFormPengajuanManager']);
Route::post('pengajuanManager', [PengajuanController::class, 'pengajuanManager']);
Route::get('showFormPengembalianManager', [PengembalianController::class, 'showFormPengembalianManager']);
Route::get('showDataPengajuanSayaManager', [PengajuanController::class, 'showDataPengajuanSayaManager']);
Route::get('dataPengajuanDivisiManager', [PengajuanController::class, 'dataPengajuanDivisiManager']);
Route::get('showAnggotaDivisiManager', [SupportController::class, 'showAnggotaDivisiManager']);
Route::post('hasilPengajuanAtasanManager/{id}/{token}/{id_unit}', [PengajuanController::class, 'hasilPengajuanAtasanManager']);



// Pengadaan

// Route::get('showDataPengadaanSaya', [PengadaanController::class, 'showDataPengadaanSaya']);
// Route::get('showDataPengadaanSayaAtasan', [PengadaanController::class, 'showDataPengadaanSayaAtasan']);
// Route::get('showDataPengadaanDivisi', [PengadaanController::class, 'showDataPengadaanDivisi']);
// Route::get('showDataPengadaanit', [PengadaanController::class, 'showDataPengadaanit']);
// Route::get('reqPengadaanDivisi', [PengadaanController::class, 'reqPengadaanDivisi']);
// Route::get('reqPengadaanIt', [PengadaanController::class, 'reqPengadaanIt']);
// Route::get('reqPengadaanAdminIt', [PengadaanController::class, 'reqPengadaanAdminIt']);
// Route::get('ProgressPengadaanIt', [PengadaanController::class, 'ProgressPengadaanIt']);
// Route::get('ProgressPengadaanItAcc', [PengadaanController::class, 'ProgressPengadaanItAcc']);
// Route::post('saveUnitPengadaan', [PengadaanController::class, 'saveUnitPengadaan']);
// Route::post('saveUnitPengadaanAtasan', [PengadaanController::class, 'saveUnitPengadaanAtasan']);
// Route::post('apprvPengadaanAtasan/{acc}/{id}', [PengadaanController::class, 'apprvPengadaanAtasan']);
// Route::post('apprvPengadaanIt/{acc}/{id}', [PengadaanController::class, 'apprvPengadaanIt']);
// Route::post('apprvPengadaanAdminIt/{acc}/{id}', [PengadaanController::class, 'apprvPengadaanAdminIt']);
// Route::post('ApprvProgressPengadaanIt/{id}', [PengadaanController::class, 'ApprvProgressPengadaanIt']);
// Route::post('ApprvProgressPengadaanItAcc/{id}', [PengadaanController::class, 'ApprvProgressPengadaanItAcc']);
// Route::get('showFormPengadaan', [PengadaanController::class, 'showFormPengadaan']);
// Route::get('showFormPengadaanAtasan', [PengadaanController::class, 'showFormPengadaanAtasan']);
