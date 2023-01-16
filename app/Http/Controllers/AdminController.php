<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use DataTables; 

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

    public function getKecamatan(Request $request)
    {
        if ($request->ajax()) {
            $data = Kecamatan::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('warna', function($row){
                    $kotak = '<div style="background-color:'.$row->warnaKecamatan.'; width:25px; height:25px; border:1px solid #000;"></div>';
                    return $kotak;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="kecamatan/'.$row->id.'/edit" class="edit btn btn-success btn-sm">Edit</a> <a href="kecamatan/'.$row->id.'/delete" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'warna'])
                ->make(true);
        }
    }
}
