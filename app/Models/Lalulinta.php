<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lalulinta extends Model
{
    use HasFactory;
    protected $fillable = [
        'tahun', 'volume', 'kecepatan', 'jalanKecamatanId', 'tingkatPelayanan', 'tingkatKemacetan', 'ratio'
    ];
}
