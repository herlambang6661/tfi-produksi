<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratkontrakitmModel extends Model
{
    use HasFactory;

    protected $table = "kontrak_suratkontrakitm";

    protected $fillable = [
        'noform',
        'id_kontrak',
        'tanggal',
        'tipe',
        'kategori',
        'warna',
        'berat',
        'harga',
        'lock',
        'status',
        'dibuat',
        'created_at',
        'updated_at',
    ];
}
