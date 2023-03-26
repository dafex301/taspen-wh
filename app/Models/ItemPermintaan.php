<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPermintaan extends Model
{
    use HasFactory;

    // Fillable
    protected $fillable = [
        'id_permintaan',
        'id_item',
        'jumlah',
    ];

    // Relation with Item
    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item');
    }

    // Relation with Pengadaan
    public function permintaan()
    {
        return $this->belongsTo(Permintaan::class, 'id_permintaan');
    }
}
