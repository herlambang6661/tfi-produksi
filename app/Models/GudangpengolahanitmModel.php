<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GudangpengolahanitmModel extends Model
{
    protected $table = "gudang_pengolahanitm";

    protected $fillable = [
        'tanggal',
        'kodeolah',
        'subkode',
        'package',
        'berat',
        'operator',
        'status',
        'dibuat',
        'created_at',
        'updated_at',
    ];
}
