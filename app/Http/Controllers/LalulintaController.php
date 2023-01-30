<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Lalulinta;
use App\Models\Jalan;
use App\Models\Kecamatan;
use DataTables;

class LalulintaController extends Controller
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
            $data = DB::table('lalulintas')
                    ->join('jalans_kecamatans', 'lalulintas.jalanKecamatanId', '=', 'jalans_kecamatans.id')
                    ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                    ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                    ->select('lalulintas.*', 'jalans.namaJalan', 'kecamatans.namaKecamatan',)
                    ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-success btn-sm editLalin">Edit</a> ';
                    $actionBtn = $actionBtn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteLalin">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
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
        return view('admin/data_lalu_lintas', compact('kecamatans', 'jalans', 'data' ,'dataKec', 'dataJln'));
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
            'volume' => 'required',
            'tahun' => 'required',
        ]);

        LaluLinta::updateOrCreate([
            'id' => $request->lalinId
        ],  [
            'volume' => $request->volume,
            'kecepatan' => $request->kecepatan,
            'tahun' => $request->tahun,
            'jalanKecamatanId' => $request->jalanKecamatanId,
        ]);

        return redirect()->route('lalulinta.index');
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
        $data = DB::table('lalulintas')
                    ->join('jalans_kecamatans', 'lalulintas.jalanKecamatanId', '=', 'jalans_kecamatans.id')
                    ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                    ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                    ->select('lalulintas.*', 'jalans.id AS jalanId', 'kecamatans.id AS kecamatanId',)
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
            'volumeLaluLintas' => 'required',
        ]);

        $lalulinta = Lalulinta::find($id);
        
        $lalulinta->update($request->all());

        return redirect()->route('lalulinta.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lalulinta = Lalulinta::find($id);
        $lalulinta->delete();
        return response()->json(['success'=>'Product deleted successfully.']);
    }
}
