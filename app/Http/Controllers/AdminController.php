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
        $apills = Apill::get();
        return view('admin/peta_apill', compact('kecamatans', 'apills'));
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
                                <a href="/administrator/jalan/'.$row->id.'/edit" class="edit btn btn-success btn-sm" data-id=".$row->id.">Edit</a>
                                <button type="button" class="delete btn btn-danger btn-sm" data-target="#modalHapusJalan" data-toggle="modal" >Delete</button>
                               
                                <div id="modalHapusJalan" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="hapus-jalan">Hapus Data Jalan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda yakin ingin menghapus data ini ?</p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <a href="/administrator/jalan/'.$row->id.'/delete" class="btn btn-danger">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
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
                                <button type="button" class="delete btn btn-danger btn-sm" data-target="#modalHapusLaluLintas" data-toggle="modal" >Delete</button>
                               
                                <div id="modalHapusLaluLintas" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="hapus-jalan">Hapus Data Lalu Lintas</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda yakin ingin menghapus data ini ?</p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <a href="/administrator/lalulinta/'.$row->id.'/delete" class="btn btn-danger">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
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
                        <button type="button" class="delete btn btn-danger btn-sm" data-target="#modalHapusKecamatan" data-toggle="modal" >Delete</button>
                               
                        <div id="modalHapusKecamatan" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapus-kecelakaan">Hapus Data Kecelakaan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Anda yakin ingin menghapus data ini ?</p>
                                </div>
    
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <a href="/administrator/kecelakaan/'.$row->id.'/delete" class="btn btn-danger">Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function getApill(Request $request)
    {
        if($request->ajax())
        {
            $data = Apill::get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionBtn = '<a href="/administrator/apill/'.$row->id.'/edit"class="edit btn btn-success btn-sm">Edit</a>
                        <button type="button" class="delete btn btn-danger btn-sm" data-target="#modalHapusAPILL" data-toggle="modal" >Delete</button>
                               
                        <div id="modalHapusAPILL" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapus-apill">Hapus Data APILL</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Anda yakin ingin menghapus data ini ?</p>
                                </div>
    
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <a href="/administrator/apill/'.$row->id.'/delete" class="btn btn-danger">Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>';
                    return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }
}