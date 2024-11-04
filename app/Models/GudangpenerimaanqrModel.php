<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GudangpenerimaanqrModel extends Model
{

    protected $table = "gudang_penerimaanqrcode";

    protected $fillable = [
        'tanggal',
        'npb',
        'kodekontrak',
        'subkode',
        'nourut',
        'berat_satuan',
        'berat_total',
        'qty_total',
        'type',
        'status',
        'dibuat',
        'created_at',
        'updated_at',
    ];
}
