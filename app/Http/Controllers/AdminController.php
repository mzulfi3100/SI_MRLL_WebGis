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
        $kecelakaan = TitikKecelakaan::orderBy('lokasiKecelakaan')->get();
        $apill = Apill::orderBy('namaSimpang')->get();        
        $kecamatans = Kecamatan::orderBy('namaKecamatan')->get();
        $jalans = DB::table('jalans_kecamatans')
                    ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                    ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                    ->orderBy('jalans.namaJalan')
                    ->select('jalans.*', 'jalans_kecamatans.kecamatanId', 'kecamatans.namaKecamatan', 'kecamatans.geoJsonKecamatan', 'kecamatans.warnaKecamatan', 'jalans_kecamatans.id AS jalanKecamatanId')
                    ->get();
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
                ->select('lalulintas.*','jalans.*', 'kecamatans.namaKecamatan', 'jalans.id AS jalanId', 'kecamatans.id AS kecamatanId', 'jalans_kecamatans.id AS jalanKecamatanId', 'lalulintas.ratio')
                ->get();  
        $titikLaka = DB::table('titik_kecelakaans')
                ->join('jalans_kecamatans', 'titik_kecelakaans.jalanKecamatanId', '=', 'jalans_kecamatans.id')
                ->join('jalans', 'jalans.id', '=', 'jalans_kecamatans.jalanId')
                ->join('kecamatans', 'kecamatans.id', '=', 'jalans_kecamatans.kecamatanId')
                ->orderBy('titik_kecelakaans.lokasiKecelakaan')
                ->select('titik_kecelakaans.*', 'jalans.*', 'titik_kecelakaans.id as titikID', 'jalans.id as jalanID', 'kecamatans.namaKecamatan')
                ->get();
        $titikMacet = TitikKemacetan::orderBy('lokasiKemacetan')->get();
        $kecamatans = Kecamatan::orderBy('namaKecamatan')->get();
        $jalans = DB::table('jalans_kecamatans')
                    ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                    ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                    ->orderBy('jalans.namaJalan')
                    ->select('jalans.*', 'jalans_kecamatans.kecamatanId', 'kecamatans.namaKecamatan', 'kecamatans.geoJsonKecamatan', 'kecamatans.warnaKecamatan', 'jalans_kecamatans.id AS jalanKecamatanId')
                    ->get();
        $apills = Apill::orderBy('namaSimpang')->get();        
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
        $titikMacet = TitikKemacetan::orderBy('lokasiKemacetan')->get();
        $kecamatans = Kecamatan::orderBy('namaKecamatan')->get();
        $jalans = DB::table('jalans_kecamatans')
                    ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                    ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                    ->orderBy('jalans.namaJalan')
                    ->select('jalans.*', 'jalans_kecamatans.kecamatanId', 'kecamatans.namaKecamatan', 'kecamatans.geoJsonKecamatan', 'kecamatans.warnaKecamatan', 'jalans_kecamatans.id AS jalanKecamatanId')
                    ->get();
        return view('admin/peta_kemacetan', compact('kecamatans', 'jalans', 'data', 'titikMacet'));
    }

    public function peta_kecelakaan(){
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
                    ->join('kecamatans', 'kecamatans.id', '=', 'jalans_kecamatans.kecamatanId')
                    ->orderBy('titik_kecelakaans.lokasiKecelakaan')
                    ->select('titik_kecelakaans.*', 'jalans.*', 'titik_kecelakaans.id as titikID', 'jalans.id as jalanID', 'kecamatans.namaKecamatan')
                    ->get();
            
        $kecamatans = Kecamatan::orderBy('namaKecamatan')->get();
        $jalans = DB::table('jalans_kecamatans')
                    ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                    ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                    ->orderBy('jalans.namaJalan')
                    ->select('jalans.*', 'jalans_kecamatans.kecamatanId', 'kecamatans.namaKecamatan', 'kecamatans.geoJsonKecamatan', 'kecamatans.warnaKecamatan', 'jalans_kecamatans.id AS jalanKecamatanId')
                    ->get();
        return view('admin/peta_kecelakaan', compact('kecamatans', 'jalans', 'titikLaka', 'data'));
    }
    
    public function peta_apill(){
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
        $kecamatans = Kecamatan::orderBy('namaKecamatan')->get();
        $jalans = DB::table('jalans_kecamatans')
                    ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                    ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                    ->orderBy('jalans.namaJalan')
                    ->select('jalans.*', 'jalans_kecamatans.kecamatanId', 'kecamatans.namaKecamatan', 'kecamatans.geoJsonKecamatan', 'kecamatans.warnaKecamatan', 'jalans_kecamatans.id AS jalanKecamatanId')
                    ->get();
        $apills = Apill::orderBy('namaSimpang')->get();  
        return view('admin/peta_apill', compact('kecamatans', 'apills', 'jalans', 'data'));
    }
}