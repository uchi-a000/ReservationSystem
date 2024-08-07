<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function reservation(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites', 'shop_id', 'user_id');
    }
}
