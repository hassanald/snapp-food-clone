<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\StoreRestauranCategoryRequest;
use App\Http\Requests\UpdateRestauranCategoryRequest;
use App\Models\RestaurantCategory;

class RestaurantCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $categories = RestaurantCategory::paginate(3);

        return view('admin.category.restaurant.index' , compact('categories'));
    }

    public function create(){

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestauranCategoryRequest $request)
    {
        RestaurantCategory::create($request->all());

        return redirect()->back()->with('success' , 'Category Created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(RestaurantCategory $restauranCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = RestaurantCategory::findOrFail($id);
        return view('admin.category.restaurant.edit' , compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRestauranCategoryRequest $request,  $id)
    {
        $categroy = RestaurantCategory::findOrFail($id);
        $categroy->update($request->all());

        return redirect()->to(route('rest.cat.index'))->with('success' , 'Category Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categroy = RestaurantCategory::findOrFail($id);
        $categroy->delete();

        return redirect()->to(route('rest.cat.index'))->with('success' , 'Category Deleted successfully!');
    }
}
