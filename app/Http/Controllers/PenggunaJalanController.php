<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Kecamatan;
use App\Models\Jalan;
use App\Models\Lalulinta;
use App\Models\Kecelakaan;
use App\Models\Apill;
use App\Models\TitikKemacetan;
use App\Models\TitikKecelakaan;

class PenggunaJalanController extends Controller
{
    public function index(Request $request)
    {
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
                ->select('titik_kecelakaans.*', 'jalans.*', 'titik_kecelakaans.id as titikID', 'jalans.id as jalanID')
                ->get();
        $titikMacet = TitikKemacetan::get();
        $kecamatans = Kecamatan::get();
        $jalans = DB::table('jalans_kecamatans')
                    ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                    ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                    ->select('jalans.*', 'jalans_kecamatans.kecamatanId', 'kecamatans.namaKecamatan', 'kecamatans.geoJsonKecamatan', 'kecamatans.warnaKecamatan', 'jalans_kecamatans.id AS jalanKecamatanId')
                    ->get();
        $apills = Apill::get();

        return view('penggunaJalan/landingPage', compact('kecamatans', 'jalans', 'data', 'titikLaka', 'apills', 'titikMacet'));
    }

    public function detailJalan($id){
        $jalan = DB::table('jalans_kecamatans')
                    ->join('jalans', 'jalans_kecamatans.jalanId', '=', 'jalans.id')
                    ->join('kecamatans', 'jalans_kecamatans.kecamatanId', '=', 'kecamatans.id')
                    ->where('jalans_kecamatans.id', '=', $id)
                    ->select('jalans.*', 'jalans_kecamatans.kecamatanId', 'kecamatans.namaKecamatan', 'kecamatans.geoJsonKecamatan', 'kecamatans.warnaKecamatan', 'jalans_kecamatans.id AS jalanKecamatanId')
                    ->first();

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

        $lalulintas = DB::table('lalulintas')
                        ->where('lalulintas.tahun', '>', DB::raw('year(NOW()) - 3'))
                        ->where('lalulintas.jalanKecamatanId', '=', $id)
                        ->orderBy('lalulintas.tahun', 'desc')
                        ->get();
        $kecelakaan = DB::table('titik_kecelakaans')
                        ->where(DB::raw('extract(year from titik_kecelakaans.tanggalKecelakaan)'), '>', DB::raw('year(NOW()) - 3'))
                        ->where('titik_kecelakaans.jalanKecamatanId', '=', $id)
                        ->orderBy(DB::raw('titik_kecelakaans.tanggalKecelakaan'), 'desc')
                        ->select(DB::raw('sum(titik_kecelakaans.korbanMD) as korbanMD'), DB::raw('sum(titik_kecelakaans.korbanLB) as korbanLB'), DB::raw('sum(titik_kecelakaans.korbanLR) as korbanLR'), DB::raw('count(*) as jumlahKecelakaan'), DB::raw('extract(year from titik_kecelakaans.tanggalKecelakaan) as tahunKecelakaan'))
                        ->groupBy(DB::raw('extract(year from titik_kecelakaans.tanggalKecelakaan)'))
                        ->get();
        $titikMacet = TitikKemacetan::where('jalanKecamatanId', $id)->get();
        $titikLaka = TitikKecelakaan::where('jalanKecamatanId', $id)->get();
        return view('penggunaJalan/detail_jalan', compact('jalan', 'lalulintas', 'kecelakaan', 'titikLaka', 'titikMacet', 'data'));
    }
}
