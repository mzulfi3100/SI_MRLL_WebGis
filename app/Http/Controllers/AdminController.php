<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;

class AdminController extends Controller
{
    //
    public function index(){
        $kecamatans = Kecamatan::get();
        return view('admin/dashboard', compact('kecamatans'));
    }

    public function peta_kemacetan(){
        $kecamatans = Kecamatan::get();
        $kabupaten = json_decode(file_get_contents(public_path() . "\kabupaten.geojson"), true);
        return view('admin/peta_kemacetan', compact('kecamatans', 'kabupaten'));
    }

    public function peta_kecelakaan(){
        $kecamatans = Kecamatan::get();
        return view('admin/peta_kecelakaan', compact('kecamatans'));
    }
}
