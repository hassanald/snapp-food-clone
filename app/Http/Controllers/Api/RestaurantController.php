<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Http\Resources\RestaurantResource;
use App\Models\Address;
use App\Models\Food;
use App\Models\Restaurant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    public function index(){
        $userAddress = Address::where('user_id' , auth()->user()->id)
            ->where('is_current' , 1)->first();

        $restaurants = Restaurant::with( 'user' , 'category' , 'foods' , 'images')
            ->select(DB::raw('*, ( 6367 * acos( cos( radians('.$userAddress->latitude.') ) * cos( radians( latitude ) )
            * cos( radians( longitude ) - radians('.$userAddress->longitude.') ) + sin( radians('.$userAddress->latitude.') ) *
            sin( radians( latitude ) ) ) ) AS distance'))
            ->when(\request()->filled('type') , function ($query){
                $query->where('restaurant_category_id' , '=' , \request('type'));
            })
            ->having('distance' , '<' , 10)
            ->orderBy('distance')
            ->get();

        return RestaurantResource::collection($restaurants);
    }

    public function show($id){
        $restaurant = Restaurant::with('user' , 'category' , 'foods' , 'images')->findOrFail($id);
        return RestaurantResource::make($restaurant);
    }

    public function foods($id){
        $foods = Food::with('discount' , 'category' , 'images' , 'restaurant')
            ->where('restaurant_id' , $id)->get();
        return FoodResource::collection($foods);
    }

}
