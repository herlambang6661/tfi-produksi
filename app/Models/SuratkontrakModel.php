<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratkontrakModel extends Model
{
    use HasFactory;

    protected $table = "kontrak_suratkontrak";

    protected $fillable = [
        'noform',
        'entitas',
        'tanggal',
        'supplier',
        'dibeli',
        'keterangan',
        'lock',
        'dibuat',
        'created_at',
        'updated_at',
    ];
}
