<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Apill;
use App\Models\Kecamatan;
use App\Models\Jalan;

class ApillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/apill/data_apill');
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
                ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                ->select('jalans.namaJalan', 'jalans_kecamatans.jalanId', 'kecamatans.namaKecamatan', 'jalans_kecamatans.kecamatanId')
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

        Apill::create($request->all());

        return redirect()->route('apill.index');
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
        $kecamatans = Kecamatan::get();
        $jalans = Jalan::get();
        $data = DB::table('jalans_kecamatans')
                ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                ->select('jalans.namaJalan', 'jalans_kecamatans.jalanId', 'kecamatans.namaKecamatan', 'jalans_kecamatans.kecamatanId')
                ->get();
        $dataKec = DB::table('jalans_kecamatans')
                    ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                    ->select('kecamatans.namaKecamatan', 'jalans_kecamatans.kecamatanId')
                    ->distinct()
                    ->get();
        $apill = Apill::find($id);
        return view('admin/apill/edit_data_apill', compact('kecamatans', 'jalans', 'apill', 'data', 'dataKec'));
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
    public function destroy($id)
    {
        $apill = Apill::find($id);
        $apill->delete();
        return redirect()->route('apill.index');
    }
}
