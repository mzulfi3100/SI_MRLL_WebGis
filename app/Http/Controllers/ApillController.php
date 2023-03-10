<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Apill;
use App\Models\Kecamatan;
use App\Models\Jalan;
use DataTables;

class ApillController extends Controller
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
            $data = Apill::latest()->get();
            return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $actionBtn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-success btn-sm editApill"><i class="fas fa-pen" style="color:white"></i></a>&nbsp;';
                            $actionBtn = $actionBtn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteApill"><i class="fa fa-trash" style="color:white"></i></a>';
                            return $actionBtn;
                        })
                        ->addColumn('checkbox', function($row){
                            return '<input type="checkbox" name="apill_checkbox" data-id="'.$row->id.'"><label></label>';
                        })
                        ->rawColumns(['action', 'checkbox'])
                        ->make(true);
        }
        $kecamatans = Kecamatan::orderBy('namaKecamatan')->get();
        $jalans = DB::table('jalans_kecamatans')
                    ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                    ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                    ->orderBy('jalans.namaJalan')
                    ->select('jalans.*', 'jalans_kecamatans.kecamatanId', 'kecamatans.namaKecamatan', 'kecamatans.geoJsonKecamatan', 'kecamatans.warnaKecamatan', 'jalans_kecamatans.id AS jalanKecamatanId')
                    ->get();
        return view('admin/apill/data_apill', compact('kecamatans', 'jalans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatans = Kecamatan::get();
        $data = DB::table('jalans_kecamatans')
                ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                ->select('jalans.namaJalan', 'jalans_kecamatans.jalanId',)
                ->distinct()
                ->get();
        $dataKec = DB::table('jalans_kecamatans')
                    ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                    ->select('kecamatans.namaKecamatan', 'jalans_kecamatans.kecamatanId')
                    ->distinct()
                    ->get();
        $jalans = Jalan::get();
        return view('admin/apill/tambah_data_apill', compact('kecamatans', 'jalans', 'data', 'dataKec'));
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
            'namaSimpang' => 'required',
            'terkoneksiATCS' => 'required',
            'geoJsonApill' => 'required',
        ]);

        Apill::updateOrCreate([
            'id' => $request->apillId
        ],  [
            'namaSimpang' => $request->namaSimpang,
            'terkoneksiATCS' => $request->terkoneksiATCS,
            'geoJsonApill' => $request->geoJsonApill,
        ]);

        return response()->json(['code'=>1, 'msg'=> ' Berhasil Menyimpan Data Apill']);
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
        $apill = Apill::find($id);
        return response()->json($apill);
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
        $request->validate([
            'kecamatanId' => 'required',
            'jalanId' => 'required',
            'namaSimpang' => 'required',
            'terkoneksiATCS' => 'required',
            'geoJsonApill' => 'required',
        ]);

        $apill = Apill::find($id);

        $apill->update($request->all());

        return redirect()->route('apill.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $apill = Apill::find($request->apillId);
        $apill->delete();
        return response()->json(['code'=>1, 'msg'=> ' Data Apill Berhasil Dihapus']);
    }
    public function deleteSelectedApill(Request $request){
        $apill_ids = $request->apill_id;
        $countApills = $request->countingApill;
        // $count_jalan = $request->jalan_id;
        //menghapus data di tabel apill berdasarkan id apill
        Apill::whereIn('id', $apill_ids)->delete();
        return response()->json(['code'=>1, 'msg'=> [$countApills, ' Data Apill Berhasil Dihapus']]);
    }
}
