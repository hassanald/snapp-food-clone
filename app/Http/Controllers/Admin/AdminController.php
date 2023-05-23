<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){

        $orders = Order::with('user' , 'status' , 'orderItems' , 'address' , 'restaurant')
            ->paginate(10);
        $ordersCount = Order::where('status_id' , '!=' , OrderStatus::getRejectId())->count();
        $income = Order::where('status_id' , '!=' , OrderStatus::getRejectId())->pluck('price')->sum();

        return view('admin.dashboard' , compact(
            'orders',
            'income',
            'ordersCount',
        ));
    }
}
