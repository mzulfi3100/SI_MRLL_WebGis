<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jalan extends Model
{
    use HasFactory;
    protected $fillable = [
        'namaJalan', 'volumeJalan', 'lebarJalan', 'panjangJalan', 'tipeJalan', 'kapasitasJalan', 'tingkatPelayananJalan',
        'kondisiJalan', 'hambatanSamping', 'geoJsonJalan',
    ];
}
