<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarsupplierModel extends Model
{
    use HasFactory;
    protected $table = "daftar_supplier";

    protected $fillable = [
        'nama',
        'npwp',
        'alamat',
        'kopos',
        'kota',
        'provinsi',
        'telp',
        'email',
        'mtuang',
        'dibuat',
        'created_at',
        'updated_at',
    ];
}
