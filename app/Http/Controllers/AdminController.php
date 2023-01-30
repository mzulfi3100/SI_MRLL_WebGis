<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Jalan;
use App\Models\Lalulinta;
use App\Models\Kecelakaan;
use App\Models\Apill;
use DataTables; 
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function index(){
        $kecamatans = Kecamatan::get();
        $jalans = Jalan::get();
        return view('admin/dashboard', compact('kecamatans', 'jalans'));
    }

    public function peta_kemacetan(){
        $kecamatans = Kecamatan::get();
        $jalans = Jalan::get();
        return view('admin/peta_kemacetan', compact('kecamatans', 'jalans'));
    }

    public function peta_kecelakaan(){
        $kecamatans = Kecamatan::get();
        $jalans = Jalan::get();
        return view('admin/peta_kecelakaan', compact('kecamatans', 'jalans'));
    }
    
    public function peta_apill(){
        $kecamatans = Kecamatan::get();
        $apills = Apill::get();
        return view('admin/peta_apill', compact('kecamatans', 'apills'));
    }
}