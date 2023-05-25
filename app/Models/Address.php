<?php

namespace App\Models;

use App\Observers\AddressObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'address',
        'latitude',
        'longitude',
        'user_id',
        'is_current',
    ];

    public static function booted():void
    {
        Address::observe(AddressObserver::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

}

