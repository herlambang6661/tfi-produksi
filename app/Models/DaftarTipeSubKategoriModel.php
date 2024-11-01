<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DaftarTipeSubKategoriModel extends Model
{
    use HasFactory;
    protected $table = 'daftar_tipe_subkategori';
    protected $fillable = [
        'kode_kategori',
        'nama_kategori',
        'dibuat',
    ];

    public function tipe(): BelongsTo
    {
        return $this->belongsTo(DaftartipeModel::class);
    }
}
