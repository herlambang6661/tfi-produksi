<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProduksipengebonanitmModel extends Model
{
    protected $table = "produksi_pengebonanitm";

    protected $fillable = [
        'tanggal',
        'formproduksi',
        'kodeproduksi',
        'subkode',
        'package',
        'type',
        'kategori',
        'warna',
        'berat',
        'operator',
        'supplier',
        'status',
        'dibuat',
        'created_at',
        'updated_at',
    ];
}
