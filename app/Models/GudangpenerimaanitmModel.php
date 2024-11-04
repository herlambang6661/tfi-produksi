<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GudangpenerimaanitmModel extends Model
{
    use HasFactory;

    protected $table = "gudang_penerimaanitm";

    protected $fillable = [
        'tanggal',
        'npb',
        'kodekontrak',
        'tipe',
        'kategori',
        'warna',
        'qty',
        'package',
        'berat_trukpenuh',
        'berat_trukkosong',
        'status',
        'dibuat',
        'created_at',
        'updated_at',

    ];
}
