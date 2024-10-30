<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DaftartipeModel extends Model
{
    use HasFactory;
    protected $table = "daftar_tipe";

    protected $fillable = [
        'kode',
        'nama',
        'dibuat',
        'created_at',
        'updated_at',
    ];

    public function warna(): HasMany
    {
        return $this->hasMany(DaftarwarnaModel::class);
    }

    public function kategori(): HasMany
    {
        return $this->hasMany(DaftarTipeSubKategoriModel::class);
    }
}
