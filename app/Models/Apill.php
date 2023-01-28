<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apill extends Model
{
    use HasFactory;
    protected $fillable = [
        'namaSimpang', 'terkoneksiATCS', 'geoJsonApill',
    ];
}
