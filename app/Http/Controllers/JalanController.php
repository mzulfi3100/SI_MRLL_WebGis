<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jalan;
use App\Models\Kecamatan;

class JalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/data_jalan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatans = Kecamatan::get();
        return view('admin/tambah_data_jalan', compact('kecamatans'));
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
            'namaJalan' => 'required',
        ]);

        Jalan::create($request->all());

        return redirect()->route('jalan.index');
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
        $jalans = Jalan::find($id);
        return view('admin/edit_data_jalan', compact('jalans', 'kecamatans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jalan $jalan)
    {
        $request->validate([
            'namaJalan' => 'required',
        ]);

        $jalan->update($request->all());

        return redirect()->route('jalan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jalans = Jalan::find($id);
        $jalans->delete();
        return redirect()->route('jalan.index');
    }
}
