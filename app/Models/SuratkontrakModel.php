<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratkontrakModel extends Model
{
    use HasFactory;

    protected $table = "kontrak_suratkontrak";

    protected $fillable = [
        'entitas',
        'id_kontrak',
        'tanggal',
        'supplier',
        'dibeli',
        'berat',
        'harga',
        'tipe',
        'warna',
        'cacatan',
        'dibuat',
        'created_at',
        'updated_at',
    ];
}
