<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealisasiPengadaanList extends Model
{
    use HasFactory;

    // fillable
    protected $fillable = [
        'pengadaan_id',
        'realisasi_pengadaan_id',
    ];

    // realisasi pengadaan
    public function realisasi_pengadaan()
    {
        return $this->belongsTo(RealisasiPengadaan::class);
    }

    // pengadaan
    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class);
    }
}
