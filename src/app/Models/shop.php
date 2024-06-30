<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shop extends Model
{
    use HasFactory;

    public $fillable = [
        'shop_name',
        'area',
        'genre',
        'description',
        'image_url',
    ];

    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }

    public function favorite()
    {
        return $this->hasMany(Favorite::class);
    }
}
