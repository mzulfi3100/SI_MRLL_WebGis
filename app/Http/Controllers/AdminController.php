<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;

class AdminController extends Controller
{
    //
    public function index(){
        return view('admin/dashboard');
    }

    public function peta_kemacetan(){
        $kecamatans = Kecamatan::get();
        return view('admin/peta_kemacetan', compact('kecamatans'));
    }
}
