<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GudangpengolahanModel extends Model
{
    protected $table = "gudang_pengolahan";

    protected $fillable = [
        'tanggal',
        'kodeolah',
        'operator',
        'status',
        'dibuat',
        'created_at',
        'updated_at',
    ];
}
