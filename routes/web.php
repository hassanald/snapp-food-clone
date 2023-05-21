<?php

use App\Http\Controllers\Admin\Category\FoodCategoryController;
use App\Http\Controllers\Admin\Category\RestaurantCategoryController;
use App\Http\Controllers\Admin\Category\RestCategoryController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Seller\CommentController;
use App\Http\Controllers\Seller\FoodController;
use App\Http\Controllers\Seller\OrderController;
use App\Http\Controllers\Seller\RestaurantController;
use App\Http\Controllers\Seller\SellerController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth' )->group(function () {
    //Admin
    Route::prefix('/admin')->middleware('role:'. Role::ADMIN)->group(function (){
        Route::get('' , [\App\Http\Controllers\Admin\AdminController::class , 'index'])->name('admin.index');
        //Rest Category
        Route::resource('/category/restaurant' , RestaurantCategoryController::class , [
            'names' => [
                'index' => 'rest.cat.index',
                'store' => 'rest.cat.store',
                'edit' => 'rest.cat.edit',
                'update' => 'rest.cat.update',
                'destroy' => 'rest.cat.destroy',
            ]
        ]);
        //Food Category
        Route::resource('/category/food' , FoodCategoryController::class , [
            'names' => [
                'index' => 'food.cat.index',
                'store' => 'food.cat.store',
                'edit' => 'food.cat.edit',
                'update' => 'food.cat.update',
                'destroy' => 'food.cat.destroy',
            ]
        ]);
        //Discount
        Route::resource('/discount' , DiscountController::class);
    });

    //Seller
    Route::prefix('/seller')->middleware('role:'.Role::SELLER)->group(function (){
        Route::get('' , [SellerController::class , 'index'])->name('seller.index');
        //Restaurant
        Route::resource('/restaurant' , RestaurantController::class , [
            'names' => [
                'index' => 'seller.rest.index',
                'create' => 'seller.rest.create',
                'store' => 'seller.rest.store',
                'edit' => 'seller.rest.edit',
                'update' => 'seller.rest.update',
                'destroy' => 'seller.rest.destroy',
            ]
        ]);
        Route::get('/restaurant/{id}/foods' , [RestaurantController::class , 'foods'])->name('seller.rest.foods');
        //Food
        Route::resource('/food' , FoodController::class , [
            'names' => [
                'index' => 'seller.food.index',
                'create' => 'seller.food.create',
                'store' => 'seller.food.store',
                'edit' => 'seller.food.edit',
                'update' => 'seller.food.update',
                'destroy' => 'seller.food.destroy',
            ]
        ]);
        //Order
        Route::get('/order/archive' , [OrderController::class , 'archive'])->name('seller.order.archive');
        Route::resource('/order' , OrderController::class , [
            'names' => [
                'index' => 'seller.order.index',
                'create' => 'seller.order.create',
                'store' => 'seller.order.store',
                'edit' => 'seller.order.edit',
                'update' => 'seller.order.update',
                'destroy' => 'seller.order.destroy',
            ]
        ]);
        Route::put('/order/{order}/status' , [OrderController::class , 'changeStatus'])->name('seller.order.status');
        //Comment
        Route::get('/comments' , [CommentController::class , 'index'])->name('seller.comment.index');
        Route::put('/comments/approve/{comment}' , [CommentController::class , 'approve'])->name('seller.comment.approve');
        Route::put('/comments/pending/{comment}' , [CommentController::class , 'pending'])->name('seller.comment.pending');
        Route::put('/comments/delete-req/{comment}' , [CommentController::class , 'deleteReq'])->name('seller.comment.deleteReq');
        Route::put('/comments/response/{comment}' , [CommentController::class , 'response'])->name('seller.comment.response');
    });
});

require __DIR__.'/auth.php';
