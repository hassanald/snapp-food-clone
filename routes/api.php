<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register' , [\App\Http\Controllers\Api\AuthController::class , 'register']);
Route::post('/login' , [\App\Http\Controllers\Api\AuthController::class , 'login']);


Route::middleware('auth:sanctum')->group(function () {
    //Logout
    Route::post('/logout' , [\App\Http\Controllers\Api\AuthController::class , 'logout']);
    //Restaurants
    Route::get('/restaurant' , [\App\Http\Controllers\Api\RestaurantController::class , 'index']);
    Route::get('/restaurant/{id}' , [\App\Http\Controllers\Api\RestaurantController::class , 'show']);
    Route::get('/restaurant/{id}/foods' , [\App\Http\Controllers\Api\RestaurantController::class , 'foods']);
    //Foods
    Route::get('/food' , [\App\Http\Controllers\Api\FoodController::class , 'index']);
    Route::get('/food/{id}' , [\App\Http\Controllers\Api\FoodController::class , 'show']);
    //Address
    Route::get('/address' , [\App\Http\Controllers\Api\AddressController::class , 'index']);
    Route::post('/address' , [\App\Http\Controllers\Api\AddressController::class , 'store']);
    Route::patch('/address/{address}' , [\App\Http\Controllers\Api\AddressController::class , 'update']);
    //User
    Route::patch('/user/{user}' , [\App\Http\Controllers\Api\UserController::class , 'update']);
    //Cart
    Route::get('/carts' , [\App\Http\Controllers\Api\CartController::class , 'index']);
    Route::post('/carts/add' , [\App\Http\Controllers\Api\CartController::class , 'store']);
    Route::put('/carts/{cart}' , [\App\Http\Controllers\Api\CartController::class , 'update']);
    Route::get('/carts/{cart}' , [\App\Http\Controllers\Api\CartController::class , 'show']);
    Route::put('/carts/{cart}/pay' , [\App\Http\Controllers\Api\CartController::class , 'pay']);
    //Order
    Route::get('/orders' , [\App\Http\Controllers\Api\OrderController::class , 'index']);

});
