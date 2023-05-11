<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statuses = OrderStatus::whereNotIn('id' , [OrderStatus::getDeliveredId() , OrderStatus::getRejectId()])->get();
        $user = auth()->user();
        $orders = Order::with('user' , 'status' , 'orderItems' , 'address')
            ->whereIn('restaurant_id' , $user->restaurants()->pluck('id')->toArray())
            ->whereNotIn('status_id' , [OrderStatus::getDeliveredId() , OrderStatus::getRejectId()])
            ->when(\request()->filled('status') , function ($query){
                $query->whereRelation('status' , 'title' , '=' , \request()->get('status'));
            })
            ->paginate(10);

        return view('seller.order.index' , compact('orders' , 'statuses'));
    }

    public function archive(){
        $statuses = OrderStatus::whereIn('id' , [OrderStatus::getDeliveredId() , OrderStatus::getRejectId()])->get();
        $user = auth()->user();
        $orders = Order::with('user' , 'status' , 'orderItems' , 'address')
            ->whereIn('restaurant_id' , $user->restaurants()->pluck('id')->toArray())
            ->whereIn('status_id' , [OrderStatus::getDeliveredId() , OrderStatus::getRejectId()])
            ->when(\request()->filled('status') , function ($query){
                $query->whereRelation('status' , 'title' , '=' , \request()->get('status'));
            })
            ->paginate(10);

        return view('seller.order.archive' , compact('orders' , 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function changeStatus(Order $order , Request $request){
        $order->update([
                'status_id' => $request->get('status_id'
            )]);
        return redirect()->back()->with('success' , 'Order has been updated successfully!');
    }
}
