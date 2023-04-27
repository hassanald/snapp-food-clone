<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::with('user' , 'images' , 'category')
            ->where('user_id' , auth()->user()->id)->paginate(5);
        return view('seller.restaurant.index' , compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = RestaurantCategory::all();
        return view('seller.restaurant.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {
        Restaurant::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'acc_number' => $request->acc_number,
            'restaurant_category_id' => $request->restaurant_category_id,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->back()->with('success' , 'Restaurant Created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $categories = RestaurantCategory::all();

        return view('seller.restaurant.edit' , compact('restaurant' , 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantRequest $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->update($request->all());

        return redirect()->to(route('seller.rest.index'))->with('success' , 'Restaurant Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();

        return redirect()->back()->with('success' , 'Restaurant Deleted successfully!');
    }
}
