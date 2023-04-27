<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [ 'title' , 'code' , 'discount_percent' , 'expired_at' ];

    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Str::slug($value),
            set: fn($value) => ucfirst(str_replace('-' , ' ' , $value))
        );
    }

    public function food(): BelongsToMany
    {
        return $this->belongsToMany(Food::class);
    }
}
