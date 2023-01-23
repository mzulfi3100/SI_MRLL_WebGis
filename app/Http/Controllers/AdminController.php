<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Jalan;
use App\Models\Lalulinta;
use App\Models\Kecelakaan;
use DataTables; 
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function index(){
        $kecamatans = Kecamatan::get();
        return view('admin/dashboard', compact('kecamatans'));
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
        return view('admin/peta_apill', compact('kecamatans'));
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
                    $actionBtn = '<a href="kecamatan/'.$row->id.'/edit" class="edit btn btn-success btn-sm">Edit</a> 
                                <a href="kecamatan/'.$row->id.'/delete" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'warna'])
                ->make(true);
        }
    }

    public function getJalan(Request $request)
    {
        if($request->ajax())
        {
            $data = Jalan::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="/administrator/jalan/'.$row->id.'/show" class="show btn btn-primary btn-sm">Show</a>
                                <a href="/administrator/jalan/'.$row->id.'/edit" class="edit btn btn-success btn-sm">Edit</a>
                                <a href="/administrator/jalan/'.$row->id.'/delete" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getLaluLinta(Request $request)
    {
        if($request->ajax())
        {
            $data = DB::table('lalulintas')
                        ->join('jalans', 'lalulintas.jalanId', '=', 'jalans.id')
                        ->select('lalulintas.*', 'jalans.namaJalan')
                        ->get();
            // $data = Lalulinta::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="/administrator/lalulinta/'.$row->id.'/edit" class="edit btn btn-success btn-sm">Edit</a>
                                <a href="/administrator/lalulinta/'.$row->id.'/delete" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getKecelakaan(Request $request)
    {
        if($request->ajax())
        {
            $data = DB::table('kecelakaans')
                        ->join('jalans', 'kecelakaans.jalanId', '=', 'jalans.id')
                        ->select('kecelakaans.*', 'jalans.namaJalan')
                        ->get();
            // $data = Kecelakaan::get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionBtn =  ' <a href="/administrator/kecelakaan/'.$row->id.'/edit" class="edit btn btn-success btn-sm">Edit</a> 
                                        <a href="/administrator/kecelakaan/'.$row->id.'/delete" class="delete btn btn-danger btn-sm">Delete</a>
                                        ';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }
}