<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitikKecelakaan extends Model
{
    use HasFactory;
    protected $table = 'titik_kecelakaans';
    protected $fillable = [
        'id', 'tanggalKecelakaan', 'penyebabKecelakaan', 'korbanMD', 'korbanLB', 'korbanLR', 'lokasiKecelakaan', 'geoJsonKecelakaan', 'deskripsiKecelakaan', 'jalanKecamatanId'
    ];
}
