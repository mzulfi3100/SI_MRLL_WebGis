<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apill;
use App\Models\Kecamatan;

class ApillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/data_apill');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatans = Kecamatan::get();
        return view('admin/tambah_data_apill', compact('kecamatans'));
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
        $apill = Apill::find($id);
        return view('admin/edit_data_apill', compact('kecamatans', 'apill'));
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
