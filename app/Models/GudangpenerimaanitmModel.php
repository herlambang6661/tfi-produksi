<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GudangpenerimaanitmModel extends Model
{
    use HasFactory;

    protected $table = "gudang_penerimaanitm";

    protected $fillable = [
        'id_penerimaan',
        'tanggal_kedatangan',
        'kodekontrak',
        'kodepenerimaan',
        'subkode',
        'nourut',
        'status',
        'dibuat',
        'created_at',
        'updated_at',

    ];
}
