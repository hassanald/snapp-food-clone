<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Http\Resources\RestaurantResource;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(){
        $restaurants = Restaurant::with('user' , 'category' , 'foods' , 'images')->get();
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
