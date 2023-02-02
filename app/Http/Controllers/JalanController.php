<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jalan;
use App\Models\Kecamatan;
use App\Models\JalanKecamatan;
use App\Models\Lalulinta;
use App\Models\Kecelakaan;
use Illuminate\Support\Facades\DB;
use DataTables;

class JalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // mengambil data jalan
        if($request->ajax())
        {
            $data = DB::table('jalans_kecamatans')
                        ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                        ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                        ->select('jalans.*', 'jalans_kecamatans.kecamatanId', 'kecamatans.namaKecamatan', 'jalans_kecamatans.id AS jalanKecamatanId')
                        ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    // btn show
                    $actionBtn = '<a href="/administrator/jalan/'.$row->jalanKecamatanId.'/show" class="show btn btn-primary btn-sm">Show</a>';
                    // btn edit

                    $actionBtn = $actionBtn.'<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-kec="'.$row->kecamatanId.'" data-original-title="Edit" class="edit btn btn-success btn-sm editJalan" id="editJalan">Edit</a>';

                    // btn delete
                    $actionBtn = $actionBtn.'<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-kec="'.$row->kecamatanId.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteJalan" id="deleteJalan"><i class="fa fa-trash" style="color:white"></i></a>';
                    return $actionBtn;
                })
                ->addColumn('checkbox', function($row){
                    return '<input type="checkbox" name="jalan_checkbox" data-id="'.$row->id.'" data-kec="'.$row->kecamatanId.'"><label></label>';
                })
                ->rawColumns(['action','checkbox'])
                ->make(true);
        }
        // $dataKec = DB::table('jalans_kecamatans')
        //                 ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
        //                 ->select('jalans_kecamatans.kecamatanId', 'kecamatans.namaKecamatan')
        //                 ->get();
        // mengambil data kecamatan dari yang terbaru
        $kecamatans = Kecamatan::latest()->get();
        // mengambil data jalan dari yang terbaru
        $jalans = Jalan::latest()->get();
        // menampilkan view data_jalan dan mengirim data kecamatan dan jalan dari database
        return view('admin/data_jalan', compact('kecamatans', 'jalans'));
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

        // update atau create data jalan
        $jalan = Jalan::updateOrCreate([
            'id' => $request->jalanId
        ],[
            'namaJalan' => $request->namaJalan,
            'tipeJalan' => $request->tipeJalan,
            'panjangJalan' => $request->panjangJalan,
            'lebarJalan' => $request->lebarJalan,
            'kapasitasJalan' => $request->kapasitasJalan,
            'hambatanSamping' => $request->hambatanSamping,
            'kondisiJalan' => $request->kondisiJalan,
            'geoJsonJalan' => $request->geoJsonJalan,
        ]);

        JalanKecamatan::updateOrCreate([
            'jalanId' => $jalan->id,
        ],[
            'kecamatanId' => $request->kecamatanId,
        ]);
        // mengembalikan response success
        return response()->json(['success'=>'Data Jalan Telah Berhasil Disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jalan = DB::table('jalans_kecamatans')
                        ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                        ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                        ->where('jalans_kecamatans.id', '=', $id)
                        ->select('jalans.*', 'jalans_kecamatans.kecamatanId', 'kecamatans.namaKecamatan', 'kecamatans.geoJsonKecamatan')
                        ->first();

        $lalulintas = DB::table('lalulintas')
                        ->where('lalulintas.tahun', '>', DB::raw('year(NOW()) - 3'))
                        ->where('lalulintas.jalanKecamatanId', '=', $id)
                        ->orderBy('lalulintas.tahun', 'desc')
                        ->get();
        $kecelakaan = DB::table('kecelakaans')
                        ->where('kecelakaans.tahunKecelakaan', '>', DB::raw('year(NOW()) - 3'))
                        ->where('kecelakaans.jalanKecamatanId', '=', $id)
                        ->orderBy('kecelakaans.tahunKecelakaan', 'desc')
                        ->get();
        return view('admin/detail_jalan', compact('jalan', 'lalulintas', 'kecelakaan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $kecId)
    {
        $jalan = DB::table('jalans_kecamatans')
                    ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                    ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                    ->where('jalans_kecamatans.jalanId', '=', $id)
                    ->where('jalans_kecamatans.kecamatanId', '=', $kecId)
                    ->select('jalans.*', 'jalans_kecamatans.kecamatanId', 'kecamatans.namaKecamatan')
                    ->first();

        return response()->json($jalan);
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
            'geoJsonJalan' => 'required',
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
    public function destroy($id, $request)
    {
        // mengambil data jalan yang dipilih
        $jalan = db::table('jalans_kecamatans')
                    ->where('jalas_kecamatans.jalanId' , '=', $id)
                    ->where('jalas_kecamatans.kecamatanId' , '=', $request->kecamatanId)
                    ->delete();
        // mengembalikan response success
        return response()->json(['success' => 'Data Jalan Telah Berhasil Dihapus']);
    }

    public function hapus(Request $request)
    {
        JalanKecamatan::where('jalanId', $request->jalan)
                        ->where('kecamatanId', $request->kecamatan)
                        ->delete();

        $jalan = Jalan::find($request->jalan);
        $jalan->delete();

        // mengembalikan response success
        return response()->json(['success' => 'Data Jalan Telah Berhasil Dihapus']);
    }
    public function deleteSelectedJalan(Request $request){
        $jalan_ids = $request->jalan_id;
        $jalan_kecs = $request->jalan_kec;
        $countJalans = $request->countingJalan;
        // $count_jalan = $request->jalan_id;
        //menghapus data di tabel jalankecamatan berdasarkan id jalan dan id kecamatan
        JalanKecamatan::whereIn('jalanId', $jalan_ids)
                        ->whereIn('kecamatanId', $jalan_kecs)
                        ->delete();
        //menghapus data di tabel jalan berdasarkan id jalan
        Jalan::whereIn('id', $jalan_ids)->delete();
        return response()->json(['code'=>1, 'msg'=> [$countJalans, ' Data Jalan Berhasil Dihapus']]);
    }
}
