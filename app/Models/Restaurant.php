<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [ 'name' , 'phone' , 'address' , 'acc_number' ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Str::slug($value),
            set: fn($value) => ucfirst(str_replace('-' , ' ' , $value))
        );
    }

    public function foods(): HasMany
    {
        return $this->hasMany(Food::class);
    }

    public function category(): HasOne
    {
        return $this->hasOne(RestaurantCategory::class);
    }

    public function images(): MorphToMany
    {
        return $this->morphToMany(Image::class , 'imageable');
    }
}
