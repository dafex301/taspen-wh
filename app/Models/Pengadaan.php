<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    use HasFactory;

    // Fillable
    protected $fillable = [
        'kegiatan',
        'pemohon',
        'bidang',
    ];

    // Relation with user
    public function pemohon()
    {
        return $this->belongsTo(User::class, 'pemohon');
    }

    // Relation with bidang
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang');
    }
}
