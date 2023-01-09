<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KecamatanController;

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

Route::get('administrator/data_kecamatan', function () {
    return view ('admin/data_kecamatan');
});

Route::get('administrator/data_jalan', function () {
    return view ('admin/data_jalan');
});

Route::get('administrator/data_kemacetan', function () {
    return view ('admin/data_kemacetan');
});

Route::get('administrator/data_kecelakaan', function () {
    return view ('admin/data_kecelakaan');
});

Route::get('administrator/peta_kemacetan', [AdminController::class, 'peta_kemacetan']);

Route::get('administrator/peta_kecelakaan', function () {
    return view ('admin/peta_kecelakaan');
});

Route::get('administrator/tambah_data_kecamatan', function () {
    return view ('admin/tambah_data_kecamatan');
});

Route::resource('kecamatan', KecamatanController::class);

