<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jalan;
use App\Models\Kecamatan;
use App\Models\TitikKecelakaan;
use DataTables;

class TitikKecelakaanController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $data = DB::table('titik_kecelakaans')
                    ->join('jalans_kecamatans', 'titik_kecelakaans.jalanKecamatanId', '=', 'jalans_kecamatans.id')
                    ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                    ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                    ->select('titik_kecelakaans.*', 'jalans.namaJalan', 'kecamatans.namaKecamatan')
                    ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-success btn-sm editTitikLaka"><i class="fas fa-pen" style="color:white"></i></a>&nbsp;';
                    $actionBtn = $actionBtn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteTitikLaka"><i class="fa fa-trash" style="color:white"></i></a>';
                    return $actionBtn;
                })
                ->addColumn('checkbox', function($row){
                    return '<input type="checkbox" name="titikKecelakaan_checkbox" data-id="'.$row->id.'"><label></label>';
                })
                ->rawColumns(['action','checkbox'])
                ->make(true);
        }
        $data = DB::table('jalans_kecamatans')
                    ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                    ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                    ->select('jalans.namaJalan', 'jalans_kecamatans.jalanId', 'kecamatans.namaKecamatan', 'jalans_kecamatans.kecamatanId', 'jalans_kecamatans.id')
                    ->get();
        $dataKec = DB::table('jalans_kecamatans')
                    ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                    ->select('kecamatans.namaKecamatan', 'jalans_kecamatans.kecamatanId')
                    ->distinct()
                    ->get();
        $dataJln = DB::table('jalans_kecamatans')
                    ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                    ->select('jalans.namaJalan', 'jalans_kecamatans.jalanId')
                    ->distinct()
                    ->get();
        
        $kecamatans = Kecamatan::get();
        $jalans = Jalan::get();
        return view('admin/data_titik_kecelakaan', compact('kecamatans', 'jalans', 'data' ,'dataKec', 'dataJln'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'kecamatanId' => 'required',
            'jalanId' => 'required',
            'geoJsonKecelakaan' => 'required',
        ]);

        TitikKecelakaan::updateOrCreate([
            'id' => $request->titikLakaId
        ],  [
            'tanggalKecelakaan' => $request->tanggalKecelakaan,
            'penyebabKecelakaan' => $request->penyebabKecelakaan,
            'korbanMD' => $request->korbanMD,
            'korbanLB' => $request->korbanLB,
            'korbanLR' => $request->korbanLR,
            'lokasiKecelakaan' => $request->lokasiKecelakaan,
            'geoJsonKecelakaan' => $request->geoJsonKecelakaan,
            'jalanKecamatanId' => $request->jalanKecamatanId,
        ]);

        return response()->json(['success'=>'Product saved successfully.']);
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
        $data = DB::table('titik_kecelakaans')
                    ->join('jalans_kecamatans', 'titik_kecelakaans.jalanKecamatanId', '=', 'jalans_kecamatans.id')
                    ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                    ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                    ->where('titik_kecelakaans.id', '=', $id)
                    ->select('titik_kecelakaans.*', 'jalans.id AS jalanId', 'kecamatans.id AS kecamatanId',)
                    ->first();
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $titikMacet = TitikKecelakaan::find($id);
        $titikMacet->delete();
        return response()->json(['success'=>'Product deleted successfully']);
    }
    public function deleteSelectedTitikKecelakaan(Request $request){
        $titikKecelakaan_ids = $request->titikKecelakaan_id;
        $countTitikKecelakaans = $request->countingTitikKecelakaan;

        //menghapus data di tabel jalan berdasarkan id jalan
        TitikKecelakaan::whereIn('id', $titikKecelakaan_ids)->delete();
        return response()->json(['code'=>1, 'msg'=> [$countTitikKecelakaans, ' Data Titik Kecelakaan Berhasil Dihapus']]);
    }
}
