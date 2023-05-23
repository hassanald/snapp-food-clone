<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $query = Order::with('user' , 'status' , 'orderItems' , 'address' , 'restaurant')
            ->where('status_id' , '!=' , OrderStatus::getRejectId())
            ->when(\request()->filled('restaurant') , function ($query){
                $query->whereRelation('restaurant' , 'name' , 'LIKE' , \request('restaurant'));
            })
            ->when(\request()->filled('status') , function ($query){
                $query->whereRelation('status' , 'title' , 'LIKE' , \request('status'));
            });

        $restaurants = Restaurant::all();
        $orders = $query->paginate(10);
        $ordersCount = $query->count();
        $income = $query->pluck('price')->sum();

        return view('admin.dashboard' , compact(
            'orders',
            'income',
            'ordersCount',
            'restaurants',
        ));
    }
}
