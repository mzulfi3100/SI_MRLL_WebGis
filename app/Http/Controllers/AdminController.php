<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Jalan;
use App\Models\Lalulinta;
use App\Models\Kecelakaan;
use App\Models\Apill;
use App\Models\TitikKemacetan;
use App\Models\TitikKecelakaan;
use DataTables; 
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function index(){
        $kemacetan = DB::table('lalulintas')
                    ->join(DB::raw('(select lalulintas.jalanKecamatanId, max(lalulintas.tahun) as MaxDate from lalulintas group by lalulintas.jalanKecamatanId) tm'), function($join){
                        $join->on('lalulintas.jalanKecamatanId', '=', 'tm.jalanKecamatanId')
                        ->on('lalulintas.tahun', '=', 'tm.MaxDate');
                    })
                    ->join('jalans_kecamatans', 'lalulintas.jalanKecamatanId', '=', 'jalans_kecamatans.id')
                    ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                    ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                    ->select('lalulintas.*','jalans.*', 'kecamatans.namaKecamatan', 'jalans.id AS jalanId', 'kecamatans.id AS kecamatanId')
                    ->get(); 
        $kecelakaan = TitikKecelakaan::get();
        $apill = Apill::get();        
        $kecamatans = Kecamatan::get();
        $jalans = Jalan::get();
        return view('admin/dashboard', compact('kecamatans', 'jalans', 'kemacetan', 'kecelakaan', 'apill'));
    }
    
    public function peta(){
        $data = DB::table('lalulintas')
                ->join(DB::raw('(select lalulintas.jalanKecamatanId, max(lalulintas.tahun) as MaxDate from lalulintas group by lalulintas.jalanKecamatanId) tm'), function($join){
                    $join->on('lalulintas.jalanKecamatanId', '=', 'tm.jalanKecamatanId')
                    ->on('lalulintas.tahun', '=', 'tm.MaxDate');
                })
                ->join('jalans_kecamatans', 'lalulintas.jalanKecamatanId', '=', 'jalans_kecamatans.id')
                ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                ->select('lalulintas.*','jalans.*', 'kecamatans.namaKecamatan', 'jalans.id AS jalanId', 'kecamatans.id AS kecamatanId', 'jalans_kecamatans.id AS jalanKecamatanId')
                ->get();  
        $titikLaka = DB::table('titik_kecelakaans')
                ->join('jalans_kecamatans', 'titik_kecelakaans.jalanKecamatanId', '=', 'jalans_kecamatans.id')
                ->join('jalans', 'jalans.id', '=', 'jalans_kecamatans.jalanId')
                ->join('kecamatans', 'kecamatans.id', '=', 'jalans_kecamatans.jalanId')
                ->select('titik_kecelakaans.*', 'jalans.*', 'titik_kecelakaans.id as titikID', 'jalans.id as jalanID', 'kecamatans.namaKecamatan')
                ->get();
        $titikMacet = TitikKemacetan::get();
        $kecamatans = Kecamatan::get();
        $jalans = DB::table('jalans_kecamatans')
                    ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                    ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                    ->select('jalans.*', 'jalans_kecamatans.kecamatanId', 'kecamatans.namaKecamatan', 'kecamatans.geoJsonKecamatan', 'kecamatans.warnaKecamatan', 'jalans_kecamatans.id AS jalanKecamatanId')
                    ->get();
        $apills = Apill::get();

        return view('admin/peta', compact('kecamatans', 'jalans', 'data', 'titikLaka', 'apills', 'titikMacet'));
    }

    public function peta_kemacetan(){
        $data = DB::table('lalulintas')
                    ->join(DB::raw('(select lalulintas.jalanKecamatanId, max(lalulintas.tahun) as MaxDate from lalulintas group by lalulintas.jalanKecamatanId) tm'), function($join){
                        $join->on('lalulintas.jalanKecamatanId', '=', 'tm.jalanKecamatanId')
                        ->on('lalulintas.tahun', '=', 'tm.MaxDate');
                    })
                    ->join('jalans_kecamatans', 'lalulintas.jalanKecamatanId', '=', 'jalans_kecamatans.id')
                    ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                    ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                    ->select('lalulintas.*','jalans.*', 'kecamatans.namaKecamatan', 'jalans.id AS jalanId', 'kecamatans.id AS kecamatanId', 'jalans_kecamatans.id AS jalanKecamatanId')
                    ->get();  
        $titikMacet = TitikKemacetan::get();
        $kecamatans = Kecamatan::get();
        $jalans = DB::table('jalans_kecamatans')
                    ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                    ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                    ->select('jalans.*', 'jalans_kecamatans.kecamatanId', 'kecamatans.namaKecamatan', 'kecamatans.geoJsonKecamatan', 'kecamatans.warnaKecamatan', 'jalans_kecamatans.id AS jalanKecamatanId')
                    ->get();
        return view('admin/peta_kemacetan', compact('kecamatans', 'jalans', 'data', 'titikMacet'));
    }

    public function peta_kecelakaan(){
        $perhitungan = DB::table('zscores')
                        ->join('jalans_kecamatans', 'zscores.jalanKecamatanId', '=', 'jalans_kecamatans.id')
                        ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                        ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                        ->select('zscores.nilai', 'zscores.jalanKecamatanId', 'jalans.*')
                        ->get();
        $totalKecelakaan = DB::table('kecelakaans')
                            ->join(DB::raw('(select kecelakaans.jalanKecamatanId, max(kecelakaans.tahunKecelakaan) as MaxDate from kecelakaans group by kecelakaans.jalanKecamatanId) tm'), function($join){
                                $join->on('kecelakaans.jalanKecamatanId', '=', 'tm.jalanKecamatanId')
                                ->on('kecelakaans.tahunKecelakaan', '=', 'tm.MaxDate');
                            })
                            ->select('kecelakaans.*')
                            ->get();
        $titikLaka = DB::table('titik_kecelakaans')
                        ->join('jalans_kecamatans', 'titik_kecelakaans.jalanKecamatanId', '=', 'jalans_kecamatans.id')
                        ->join('jalans', 'jalans.id', '=', 'jalans_kecamatans.jalanId')
                        ->join('kecamatans', 'kecamatans.id', '=', 'jalans_kecamatans.jalanId')
                        ->select('titik_kecelakaans.*', 'jalans.*', 'titik_kecelakaans.id as titikID', 'jalans.id as jalanID', 'kecamatans.namaKecamatan')
                        ->get();
            
        $kecamatans = Kecamatan::get();
        $jalans = Jalan::get();
        // return response()->json($titikLaka);
        return view('admin/peta_kecelakaan', compact('kecamatans', 'jalans', 'perhitungan', 'totalKecelakaan', 'titikLaka'));
    }
    
    public function peta_apill(){
        $kecamatans = Kecamatan::get();
        $apills = Apill::get();
        return view('admin/peta_apill', compact('kecamatans', 'apills'));
    }
}