<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDiscountRequest;
use App\Http\Requests\UpdateDiscountRequest;
use App\Models\Discount;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discounts = Discount::paginate(5);
        return view('admin.discount.index' , compact('discounts'));
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
    public function store(StoreDiscountRequest $request)
    {
        Discount::create($request->all());
        return redirect()->back()->with('success' , 'Discount created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $discount = Discount::findOrFail($id);

        return view('admin.discount.edit' , compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiscountRequest $request, $id)
    {
        $discount = Discount::findOrFail($id);
        $discount->update($request->all());

        return redirect()->to(route('discount.index'))->with('success' , 'Discount updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $discount = Discount::findOrFail($id);
        $discount->delete();
        return redirect()->back()->with('success' , 'Discount deleted successfully!');
    }
}
