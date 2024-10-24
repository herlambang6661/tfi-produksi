<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GudangpenerimaanModel extends Model
{
    use HasFactory;

    protected $table = "gudang_penerimaan";

    protected $fillable = [
        'id_suratkontrak',
        'tanggal_kedatangan',
        'kodekontrak',
        'tipe',
        'qty',
        'satuan',
        'berat_trukpenuh',
        'berat_trukkosong',
        'nopol',
        'driver',
        'ktp',
        'keterangan',
        'dibuat',
        'created_at',
        'updated_at',
    ];
}
