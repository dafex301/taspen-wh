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

    // Relation with manager_umum
    public function manager_umum()
    {
        return $this->belongsTo(User::class, 'manager_umum');
    }

    // Relation with manager_bidang
    public function manager_bidang()
    {
        return $this->belongsTo(User::class, 'manager_bidang');
    }
}
