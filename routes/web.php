<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JalanController;
use App\Http\Controllers\LalulintaController;
use App\Http\Controllers\KecelakaanController;
use App\Http\Controllers\ApillController;
use App\Http\Controllers\TitikKemacetanController;
use App\Http\Controllers\TitikKecelakaanController;
use App\Http\Controllers\PenggunaJalanController;

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

Route::get('/', [AdminController::class, 'index']);

Route::get('administrator/peta_kemacetan', [AdminController::class, 'peta_kemacetan']);

Route::get('administrator/peta_kecelakaan', [AdminController::class, 'peta_kecelakaan']);

Route::get('administrator/tambah_data_kecamatan', function () {
    return view ('admin/tambah_data_kecamatan');
});

Route::resource('kecamatan', KecamatanController::class);

Route::get('batas_kecamatan', [AdminController::class, 'batas_kecamatan']);

Route::get('login', [AuthController::class, 'index']);

Route::post('/administrator/login_process', [AuthController::class, 'login_process'])->name('login.process');

Route::get('/administrator/register', [AuthController::class, 'register']);

Route::post('/administrator/register_process', [AuthController::class, 'register_process'])->name('register.process');

Route::get('/administrator/sign_out', [AuthController::class, 'sign_out']);

Route::get('administrator/list', [AdminController::class, 'getKecamatan'])->name('administrator.list');

Route::get('kecamatan/{id}/delete', [KecamatanController::class, 'destroy']);

Route::resource('/administrator/jalan', JalanController::class);

Route::get('/administrator/getJalan', [AdminController::class, 'getJalan'])->name('administrator.getJalan');

Route::get('/administrator/jalan/{id}/delete', [JalanController::class, 'destroy'])->name('jalan.destroy/{id}');

Route::get('/administrator/apill');

Route::get('/administrator/peta_apill', [AdminController::class, 'peta_apill']);

Route::resource('/administrator/lalulinta', LalulintaController::class);

Route::get('/administrator/getLaluLinta', [AdminController::class, 'getLaluLinta'])->name('administrator.getLaluLinta');

Route::get('/administrator/lalulinta/{id}/delete', [LalulintaController::class, 'destroy']);

Route::resource('/administrator/kecelakaan', KecelakaanController::class);

Route::get('/administrator/getKecelakaan', [AdminController::class, 'getKecelakaan'])->name('administrator.getKecelakaan');

Route::get('/administrator/kecelakaan/{id}/delete', [KecelakaanController::class, 'destroy']);

Route::resource('/administrator/apill', ApillController::class);

Route::get('/administrator/getApill', [AdminController::class, 'getApill'])->name('administrator.getApill');

Route::get('/administrator/apill/{id}/delete', [ApillController::class, 'destroy']);

Route::get('/kecamatan/delete/all/truncate', [KecamatanController::class, 'deleteAllTruncate'])->name('kecamatan.delete.all.truncate');

Route::post('/jalan/delete', [JalanController::class, 'hapus'])->name('jalan.hapus');

Route::get('/administrator/jalan/{id}/{kedId}/edit', [JalanController::class, 'edit']);

Route::post('/deleteSelectedKecamatan', [KecamatanController::class, 'deleteSelectedKecamatan'])->name('delete.selected.kecamatan');

Route::resource('/administrator/titik_kemacetan', TitikKemacetanController::class);

Route::resource('/administrator/titik_kecelakaan', TitikKecelakaanController::class);

Route::post('/administrator/kecelakaan/hitung_pemetaan', [KecelakaanController::class, 'hitung_pemetaan']);

Route::post('/deleteSelectedKecamatan', [KecamatanController::class, 'deleteSelectedKecamatan'])->name('delete.selected.kecamatan');

Route::post('/deleteSelectedJalan', [JalanController::class, 'deleteSelectedJalan'])->name('delete.selected.jalan');

Route::post('/deleteSelectedLalin', [LaluLintaController::class, 'deleteSelectedLalin'])->name('delete.selected.lalin');

Route::post('/deleteSelectedKecelakaan', [KecelakaanController::class, 'deleteSelectedKecelakaan'])->name('delete.selected.kecelakaan');

Route::post('/deleteSelectedTitikKemacetan', [TitikKemacetanController::class, 'deleteSelectedTitikKemacetan'])->name('delete.selected.titikKemacetan');

Route::post('/deleteSelectedTitikKecelakaan', [TitikKecelakaanController::class, 'deleteSelectedTitikKecelakaan'])->name('delete.selected.titikKecelakaan');

Route::post('/deleteSelectedApill', [ApillController::class, 'deleteSelectedApill'])->name('delete.selected.apill');

Route::post('/administrator/lalu_lintas/destroy', [LaluLintaController::class, 'destroy'])->name('lalulinta.destroy');

Route::post('/administrator/titikKemacetan/destroy', [TitikKemacetanController::class, 'destroy'])->name('titikKemacetan.destroy');

Route::post('/administrator/titikLaka/destroy', [TitikKecelakaanController::class, 'destroy'])->name('titikLaka.destroy');

Route::post('/administrator/kecamatan/destroy', [KecamatanController::class, 'destroy'])->name('kecamatan.destroy');

Route::post('/administrator/apill/destroy', [ApillController::class, 'destroy'])->name('apill.destroy');

Route::post('/administrator/jalan/hapus', [JalanController::class, 'hapus'])->name('jalan.hapus');

Route::post('/deleteSelectedKecelakaan', [KecelakaanController::class, 'deleteSelectedKecelakaan'])->name('delete.selected.kecelakaan');

Route::get('/administrator/jalan/{id}/show', [JalanController::class, 'show']);

/*-----------------------------------------------------------
----------------- Semua Menu Login --------------------------
------------------------------------------------------------*/
    // Route::get('/', function () {
//     return view('home', ['title' => 'Home']);
// })->name('home');

// Route::get('/register', [UserController::class, 'register'])->name('register');
// Route::post('/register', [UserController::class, 'register_action'])->name('register.action');
// Route::get('/login', [UserController::class, 'login'])->name('login');;
// Route::post('/login', [UserController::class, 'login_action'])->name('login.action');
// Route::get('password', [UserController::class, 'password'])->name('password');
// Route::post('password', [UserController::class, 'password_action'])->name('password.action');
// Route::get('logout', [UserController::class, 'logout'])->name('logout');

Route::get('dashboardPenggunaJalan', [PenggunaJalanController::class, 'index']);

Route::get('/detail_jalan/{id}', [PenggunaJalanController::class, 'detailJalan']);