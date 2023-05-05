<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Models\Food;
use Exception;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function index(){
        $foods = Food::with('discount' , 'category' , 'images' , 'restaurant')->get();
        return FoodResource::collection($foods);
    }

    public function show($id){
        try {
            $food = Food::with('discount' , 'category' , 'images' , 'restaurant')->findOrFail($id);
        } catch(Exception $exception) {        // Skipped, no exception
            return "Food does not exist";
        }
        return FoodResource::make($food);
    }
}
