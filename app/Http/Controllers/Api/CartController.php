<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Mail\OrderRegistered;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::with('restaurant' , 'status' , 'cartItems.food.discount')
            ->where('user_id' , auth()->user()->id)
            ->get();
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
            ->first();

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
        $this->authorize('view' , $cart);

        return CartResource::make($cart->load('restaurant' , 'status' , 'cartItems.food.discount'));
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
    public function update(UpdateCartRequest $request, Cart $cart )
    {
        $this->authorize('update' , $cart);

        $cartItem = CartItem::with('cart' , 'food')
            ->where('food_id' , $request->validated('food_id'))->first();

        if (!$cartItem){
            return response()->json(['message' => 'Not Found'] , 404);
        }

        if ($cartItem->count + $request->validated('count') <= 0){
            $cartItem->delete();
            if ($cart->cartItems()->count() === 0){
                $cart->delete();
            }
            return response()->noContent();
        }

        $cartItem->update([
            'count' => $cartItem->count += $request->validated('count')
        ]);
        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }

    public function pay(Cart $cart)
    {
        $this->authorize('update' , $cart);

        if (!$cart->restaurant->is_open){
            return response()->json(['message' => 'Restaurant is not Open'] , 403);
        }

        $address = auth()->user()->addresses->filter(fn($address) => $address->is_current === 1);

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'status_id' => OrderStatus::getPendingId(),
            'price' => $cart->cartItems()->sum('price'),
            'address_id' => $address->first()->id ?? auth()->user()->addresses->pluck('id')->first(),
            'restaurant_id' => $cart->restaurant_id,
        ]);

        $cart->cartItems->map(function ($orderItem) use ($order){
            OrderItem::create([
                'order_id' => $order->id,
                'food_id' => $orderItem->food_id,
                'price' => $orderItem->price,
                'count' => $orderItem->count,
            ]);
        });

        $cart->cartItems()->delete();
        $cart->delete();

        $mailData = [
            'title' => 'Your order has been registered successfully.',
            'order' => $order,
        ];

        Mail::to(auth()->user()->email)->send(new OrderRegistered($mailData));

        return response()->json(['message' => 'Your order has been registered!']);
    }
}
