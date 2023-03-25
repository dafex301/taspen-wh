<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // Relation with Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori');
    }

    // Relation with Satuan
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan');
    }
}
