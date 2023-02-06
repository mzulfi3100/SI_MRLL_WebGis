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
        $jalans = Jalan::get();
        $apills = Apill::get();

        return view('penggunaJalan/landingPage', compact('kecamatans', 'jalans', 'data', 'titikLaka', 'apills', 'titikMacet'));
    }
}
