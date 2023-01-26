<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jalan;
use App\Models\Kecelakaan;

class KecelakaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jalans = Jalan::get();  
        return view('admin/data_kecelakaan', compact('jalans'));
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
            'jalanId' => 'required',
            'vatalitasKecelakaan' => 'required',
            'tahunKecelakaan' => 'required',
        ]);

        Kecelakaan::create($request->all());

        return redirect()->route('kecelakaan.index');
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
        $kecelakaan = Kecelakaan::find($id);
        $jalans = Jalan::get();
        return view('admin/data_kecelakaan', compact('jalans', 'kecelakaan'));
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
        return redirect()->route('kecelakaan.index');
    }
}
