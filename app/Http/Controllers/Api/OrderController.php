<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::with('user' , 'status' , 'orderItems' , 'address' , 'restaurant')
            ->where('user_id' , auth()->user()->id)->get();
        return OrderResource::collection($orders);
    }
}
