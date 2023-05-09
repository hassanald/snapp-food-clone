<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Food;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::with('restaurant' , 'status' , 'cartItems.food.discount')
            ->where('user_id' , auth()->user()->id)->get();
        return CartResource::collection($carts);
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
    public function store(StoreCartRequest $request)
    {
        $food = Food::findOrFail($request->get('food_id'));

        $cart = Cart::where('user_id' , '=' , auth()->user()->id)
            ->where('restaurant_id' , '=' , $food->restaurant->id)
            ->where('status_id' , OrderStatus::getUnpaidId())->first();

        if ($cart &&
            $cartItem = CartItem::where('cart_id' , '=' , $cart->id)
            ->where('food_id' , '=' , $food->id)->first()){

            $cartItem->update([
                'count' => $cartItem->count + $request->get('count'),
                'price' => ($food->discount && ($food->discount->expired_at > now()))
                    ? ($food->price * (1 - ($food->discount->discount_percent/100))) * $request->count
                    : $food->price *($cartItem->count + $request->get('count')),
            ]);

            return response()->json(['message' => 'Food added to cart successfully' , 'cart_id' => $cart->id]);

        }elseif ($cart){
            $cart->cartItems()->create([
                'cart_id' => $cart->id,
                'price' => ($food->discount && ($food->discount->expired_at > now()))
                    ? ($food->price * (1 - ($food->discount->discount_percent/100))) * $request->count
                    : $food->price * $request->count,
                'food_id' => $food->id,
                'count' => $request->get('count'),
            ]);

            return response()->json(['message' => 'Food added to cart successfully' , 'cart_id' => $cart->id]);
        }

        $cart = Cart::create([
            'user_id' => auth()->user()->id,
            'restaurant_id' => $food->restaurant->id,
            'status_id' => OrderStatus::getUnpaidId(),
        ]);

        $cart->cartItems()->create([
            'cart_id' => $cart->id,
            'price' => ($food->discount && ($food->discount->expired_at > now()))
                ? ($food->price * (1 - ($food->discount->discount_percent/100))) * $request->count
                : $food->price * $request->count,
            'food_id' => $food->id,
            'count' => $request->get('count'),
        ]);

        return response()->json(['message' => 'Food added to cart successfully' , 'cart_id' => $cart->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
