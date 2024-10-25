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
        'jenisperson',
        'noid',
        'alamat',
        'kopos',
        'kota',
        'provinsi',
        'telp',
        'email',
        'mtuang',
        'foto1',
        'foto2',
        'dibuat',
        'created_at',
        'updated_at',
    ];
}
