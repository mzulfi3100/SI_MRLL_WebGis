<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $kecamatans = Kecamatan::first()->paginate(10);
      
        // return view('admin/data_kecamatan',compact('kecamatans'))
        //     ->with('i', (request()->input('page', 1) - 1) * 10);
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

        Kecamatan::create([
            'namaKecamatan' => $request->namaKecamatan,
            'geoJsonKecamatan' => $request->geoJsonKecamatan
        ]);
        
        return redirect()->route('kecamatan.index');
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
    public function edit(Kecamatan $kecamatan)
    {
        return view('admin/kecamatan/edit_data_kecamatan', compact('kecamatan'));
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
    public function destroy($id)
    {
        $kecamatan = Kecamatan::find($id);
        $kecamatan->delete();
        return redirect()->route('kecamatan.index');
    }
}
