<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GudangpenerimaanModel extends Model
{
    use HasFactory;

    protected $table = "gudang_penerimaan";

    protected $fillable = [
        'tanggal',
        'npb',
        'nopol',
        'ktp',
        'driver',
        'operator',
        'signDriver',
        'signOp',
        'keterangan',
        'status',
        'verified',
        'dibuat',
        'created_at',
        'updated_at',
    ];
}
