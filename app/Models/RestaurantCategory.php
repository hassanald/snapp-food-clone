<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class RestaurantCategory extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function restaurants(): HasMany
    {
        return $this->hasMany(Restaurant::class);
    }

    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst(str_replace('-' , ' ' , $value)),
            set: fn($value) => Str::slug($value)
        );
    }
}
