<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use DataTables;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kecamatan::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('warna', function($row){
                    $kotak = '<div style="background-color:'.$row->warnaKecamatan.'; width:25px; height:25px; border:1px solid #000;"></div>';
                    return $kotak;
                })
                ->addColumn('checkbox', function($row){
                    return '<input type="checkbox" name="kecamatan_checkbox" data-id="'.$row->id.'"><label></label>';
                })
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-success btn-sm editKecamatan" id="editKecamatan"><i class="fas fa-pen" style="color:white"></i></a>&nbsp;';
                    $actionBtn = $actionBtn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteKecamatan" id="deleteKecamatan"><i class="fa fa-trash" style="color:white"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'checkbox', 'warna'])
                ->make(true);
        }
        return view('admin/kecamatan/data_kecamatan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/kecamatan/tambah_data_kecamatan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $request->validate([
            'namaKecamatan' => 'required',
            'geoJsonKecamatan' => 'required',
        ]);

        if($request->warnaKecamatan == ''){
            Kecamatan::updateOrCreate([
                'id' => $request->kecamatanId
            ],[
                'namaKecamatan' => $request->namaKecamatan,
                'warnaKecamatan' => '#000000',
                'geoJsonKecamatan' => $request->geoJsonKecamatan
            ]);
        }else{
            Kecamatan::updateOrCreate([
                'id' => $request->kecamatanId
            ],[
                'namaKecamatan' => $request->namaKecamatan,
                'warnaKecamatan' => $request->warnaKecamatan,
                'geoJsonKecamatan' => $request->geoJsonKecamatan
            ]);
        }
        
        return response()->json(['code'=>1, 'msg'=> ' Berhasil Menyimpan Data Kecamatan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kecamatan = Kecamatan::find($id);
        return response()->json($kecamatan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        $request->validate([
            'namaKecamatan' => 'required',
            'warnaKecamatan' => 'required',
            'geoJsonKecamatan' => 'required',
        ]);

        $kecamatan->update($request->all());
      
        return redirect()->route('kecamatan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $kecamatan = Kecamatan::find($request->kecamatanId);
        $kecamatan->delete();
        return response()->json(['code'=>1, 'msg'=> ' Data Kecamatan Berhasil Dihapus']);
    }
    public function deleteAllTruncate(){

        $kecamatan = Kecamatan::truncate();
        return redirect()->route('kecamatan.index');
    }
    public function deleteSelectedKecamatan(Request $request){
        $kecamatan_ids = $request->kecamatan_id;
        $countKecamatans = $request->countingKecamatan;

        Kecamatan::whereIn('id', $kecamatan_ids)->delete();
        return response()->json(['code'=>1, 'msg'=> [$countKecamatans, ' Data Kecamatan Berhasil Dihapus']]);
    }
    public function exportData(Request $request){

    }
}
