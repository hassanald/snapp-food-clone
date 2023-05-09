<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderStatus extends Model
{
    use HasFactory;

    protected $fillable = [ 'title' , 'description'];

    public static function getUnpaidId(){
        $unpaid = OrderStatus::where('title' , 'unpaid')->first();
        return $unpaid->id;
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
