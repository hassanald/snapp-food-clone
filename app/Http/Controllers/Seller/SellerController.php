<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index(){
        $query = Order::with('user' , 'status' , 'orderItems' , 'address' , 'restaurant')
            ->where('status_id' , '!=' , OrderStatus::getRejectId())
            ->whereIn('restaurant_id' , auth()->user()->restaurants->pluck('id'))
            ->when(\request()->filled('restaurant') , function ($query){
                $query->whereRelation('restaurant' , 'name' , 'LIKE' , \request('restaurant'));
            })
            ->when(\request()->filled('status') , function ($query){
                $query->whereRelation('status' , 'title' , 'LIKE' , \request('status'));
            });

        $restaurants = Restaurant::where('user_id' , auth()->user()->id)->get();
        $orders = $query->paginate(10);
        $ordersCount = $query->count();
        $income = $query->pluck('price')->sum();

        return view('seller.dashboard' , compact(
            'orders',
            'income',
            'ordersCount',
            'restaurants',
        ));
    }
}
