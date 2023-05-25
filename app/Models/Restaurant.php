<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;

class Restaurant extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'phone',
        'address',
        'acc_number',
        'restaurant_category_id',
        'user_id',
        'latitude',
        'longitude',
        'schedule',
        'is_open',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst(str_replace('-' , ' ' , $value)),
            set: fn($value) => Str::slug($value)
        );
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function foods(): HasMany
    {
        return $this->hasMany(Food::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(RestaurantCategory::class , 'restaurant_category_id');
    }

    public function images(): MorphToMany
    {
        return $this->morphToMany(Image::class , 'imageable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
