<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_id',
        'reservation_date',
        'reservation_time',
        'number_of_people',
        'check_in',
        'paid'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

}
