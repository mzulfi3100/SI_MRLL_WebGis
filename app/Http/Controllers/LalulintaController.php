<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lalulinta;
use App\Models\Jalan;

class LalulintaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jalans = Jalan::get();
        return view('admin/data_lalu_lintas', compact('jalans'));
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
            'volumeLaluLintas' => 'required',
        ]);

        Lalulinta::create($request->all());

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
        $lalulinta = Lalulinta::find($id);
        $jalans = Jalan::get();
        return view('admin/edit_data_lalu_lintas', compact('lalulinta', 'jalans'));
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
        return redirect()->route('lalulinta.index');
    }
}
