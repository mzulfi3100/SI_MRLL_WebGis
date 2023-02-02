<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jalan;
use App\Models\Kecelakaan;
use App\Models\Kecamatan;
use App\Models\Zscore;
use DataTables;

class KecelakaanController extends Controller
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
            $data = DB::table('kecelakaans')
                    ->join('jalans_kecamatans', 'kecelakaans.jalanKecamatanId', '=', 'jalans_kecamatans.id')
                    ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                    ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                    ->select('kecelakaans.*', 'jalans.namaJalan', 'kecamatans.namaKecamatan',)
                    ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-success btn-sm editLaka"><i class="fas fa-pen" style="color:white"></i></a>&nbsp;';
                    $actionBtn = $actionBtn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteLaka"><i class="fa fa-trash" style="color:white"></i></a>';
                    return $actionBtn;
                })
                ->addColumn('checkbox', function($row){
                    return '<input type="checkbox" name="kecelakaan_checkbox" data-id="'.$row->id.'"><label></label>';
                })
                ->rawColumns(['action', 'checkbox'])
                ->make(true);
        }
        $perhitungan = DB::table('perhitungan_data_kecelakaans')
                        ->join('jalans_kecamatans', 'perhitungan_data_kecelakaans.jalanKecamatanId', '=', 'jalans_kecamatans.id')
                        ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                        ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                        ->select('perhitungan_data_kecelakaans.*')
                        ->get();
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
        return view('admin/data_kecelakaan', compact('kecamatans', 'jalans', 'data' ,'dataKec', 'dataJln', 'perhitungan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


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
        ]);

        Kecelakaan::updateOrCreate([
            'id' => $request->lakaId
        ],  [
            'jumlahKorbanMeninggalDunia' => $request->jumlahKorbanMeninggalDunia,
            'jumlahKorbanLukaBerat' => $request->jumlahKorbanLukaBerat,
            'jumlahKorbanLukaRingan' => $request->jumlahKorbanLukaRingan,
            'penyebabKecelakaan' => $request->penyebabKecelakaan,
            'totalKecelakaan' => $request->totalKecelakaan,
            'tahunKecelakaan' => $request->tahunKecelakaan,
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
        $data = DB::table('kecelakaans')
                    ->join('jalans_kecamatans', 'kecelakaans.jalanKecamatanId', '=', 'jalans_kecamatans.id')
                    ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                    ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                    ->where('kecelakaans.id', '=', $id)
                    ->select('kecelakaans.*', 'jalans.id AS jalanId', 'kecamatans.id AS kecamatanId')
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
        $request->validate([
            'jalanId' => 'required',
            'vatalitasKecelakaan' => 'required',
            'tahunKecelakaan' => 'required',
        ]);

        $kecelakaan = Kecelakaan::find($id);
        $kecelakaan->update($request->all());

        return redirect()->route('kecelakaan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kecelakaan = Kecelakaan::find($id);
        $kecelakaan->delete();
        return response()->json(['success'=>'Product deleted successfully.']);
    }

    public function hitung_pemetaan(Request $request)
    {
        Zscore::truncate();
        $data = $request->all();
        $i = 0;
        foreach($data as $key){
            $zscore = new Zscore;    
            $zscore->nilai = $data['zscore'][$i];
            $zscore->jalanKecamatanId = $data['jalanKecamatanId'][$i];
            $zscore->save();
            $i++;
        }

        return redirect()->route('kecelakaan.index');
    }
    public function deleteSelectedKecelakaan(Request $request){
        $kecelakaan_ids = $request->kecelakaan_id;
        $countKecelakaans = $request->countingKecelakaan;

        //menghapus data di tabel Lalu lintas berdasarkan id lalin
        Kecelakaan::whereIn('id', $kecelakaan_ids)->delete();
        return response()->json(['code'=>1, 'msg'=> [$countKecelakaans, ' Data Kecelakaan Berhasil Dihapus']]);
    }
}
