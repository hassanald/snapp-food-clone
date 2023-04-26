<?php

use App\Http\Controllers\Admin\Category\FoodCategoryController;
use App\Http\Controllers\Admin\Category\RestaurantCategoryController;
use App\Http\Controllers\Admin\Category\RestCategoryController;
use App\Http\Controllers\ProfileController;
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
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
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
    });
});

require __DIR__.'/auth.php';
