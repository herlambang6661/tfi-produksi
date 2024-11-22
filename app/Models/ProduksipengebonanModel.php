<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProduksipengebonanModel extends Model
{
    protected $table = "produksi_pengebonan";

    protected $fillable = [
        'tanggal',
        'kodeproduksi',
        'operator',
        'keterangan',
        'status',
        'dibuat',
        'created_at',
        'updated_at',
    ];
}
