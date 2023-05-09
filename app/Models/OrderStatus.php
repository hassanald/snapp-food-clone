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
        $status = OrderStatus::where('title' , 'unpaid')->first();
        return $status->id;
    }

    public static function getRejectId(){
        $status = OrderStatus::where('title' , 'reject')->first();
        return $status->id;
    }

    public static function getPendingId(){
        $status = OrderStatus::where('title' , 'pending')->first();
        return $status->id;
    }

    public static function getPreparingId(){
        $status = OrderStatus::where('title' , 'preparing')->first();
        return $status->id;
    }

    public static function getDeliveringId(){
        $status = OrderStatus::where('title' , 'delivering')->first();
        return $status->id;
    }

    public static function getDeliveredId(){
        $status = OrderStatus::where('title' , 'delivered')->first();
        return $status->id;
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
