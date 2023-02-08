<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jalan extends Model
{
    use HasFactory;
    protected $fillable = [
        'namaJalan', 'lebarJalan', 'panjangJalan', 'tipeJalan', 'fungsiJalan', 'kapasitasJalan', 'kondisiJalan', 
        'hambatanSamping', 'geoJsonJalan',
    ];
}
