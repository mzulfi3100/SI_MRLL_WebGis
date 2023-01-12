<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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

Route::get('dashboardPenggunaJalan', function () {
    return view ('penggunaJalan/landingPage');
});