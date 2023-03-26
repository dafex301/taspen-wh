<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPengadaan extends Model
{
    use HasFactory;

    // Fillable
    protected $fillable = [
        'id_pengadaan',
        'id_item',
        'jumlah',
    ];

    // Relation with Item
    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item');
    }

    // Relation with Pengadaan
    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class, 'id_pengadaan');
    }
}
