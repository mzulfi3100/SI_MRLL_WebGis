<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitikKemacetan extends Model
{
    use HasFactory;
    protected $table = 'titik_kemacetans';
    protected $fillable = [
        'id', 'lokasiKemacetan', 'geoJsonKemacetan', 'deskripsiKemacetan', 'jalanKecamatanId'
    ];
}
