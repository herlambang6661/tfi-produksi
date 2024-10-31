<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DaftarwarnaModel extends Model
{
    use HasFactory;
    protected $table = "daftar_tipewarna";

    protected $fillable = [
        'kode_warna',
        'id_tipe',
        'warna',
        'dibuat',
        'created_at',
        'updated_at',
    ];

    public function tipe(): BelongsTo
    {
        return $this->belongsTo(DaftartipeModel::class);
    }
}
