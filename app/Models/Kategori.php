<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
    ];

    // Relation with Item
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
