<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealisasiPengadaan extends Model
{
    use HasFactory;

    // fillable, penanggung_jawab
    protected $fillable = [
        'penanggung_jawab',
    ];

    public function penanggungJawab()
    {
        return $this->belongsTo(User::class, 'penanggung_jawab');
    }
}
