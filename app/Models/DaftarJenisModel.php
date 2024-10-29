<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarJenisModel extends Model
{

    use HasFactory;
    protected $table = 'daftar_jenis';
    protected $fillable = [
        'nama_jenis',
        'dibuat',
    ];
}
