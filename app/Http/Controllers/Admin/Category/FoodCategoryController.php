<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFoodCategoryRequest;
use App\Http\Requests\UpdateFoodCategoryRequest;
use App\Models\FoodCategory;

class FoodCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = FoodCategory::paginate(3);

        return view('admin.category.food.index' , compact('categories'));
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
    public function store(StoreFoodCategoryRequest $request)
    {
        FoodCategory::create($request->all());

        return redirect()->back()->with('success' , 'Category Created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodCategory $foodCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = FoodCategory::findOrFail($id);
        return view('admin.category.food.edit' , compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreFoodCategoryRequest $request, $id)
    {
        $categroy = FoodCategory::findOrFail($id);
        $categroy->update($request->all());

        return redirect()->to(route('food.cat.index'))->with('success' , 'Category Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categroy = FoodCategory::findOrFail($id);
        $categroy->delete();

        return redirect()->to(route('food.cat.index'))->with('success' , 'Category Deleted successfully!');
    }
}
