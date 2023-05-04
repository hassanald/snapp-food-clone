<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index(){
        $foods = Food::with('discount' , 'category' , 'images' , 'restaurant')->get();
        return FoodResource::collection($foods);
    }

    public function show($id){
        $food = Food::with('discount' , 'category' , 'images' , 'restaurant')->findOrFail($id);
        return FoodResource::make($food);
    }
}
