<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;

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
