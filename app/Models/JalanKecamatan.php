<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JalanKecamatan extends Model
{
    use HasFactory;
    protected $table = 'jalans_kecamatans';
    protected $fillable = [
        'jalanId', 'kecamatanId',
    ];
}
