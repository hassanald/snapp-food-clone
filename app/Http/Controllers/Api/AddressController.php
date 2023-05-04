<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AddressController extends Controller
{
    public function index(){
        $addresses = Address::with('user')->where('user_id' , \auth()->user()->id)->get();

        return AddressResource::collection($addresses);
    }

    public function store(StoreAddressRequest $request){
        $user = Auth::user();
        $address = $user->addresses()->create($request->validated());

        return response()->json(['message' => 'Address added successfully!' , 'data' => AddressResource::make($address) ]);
    }

    public function update(UpdateAddressRequest $request , Address $address){
//        if ( Gate::allows('can-update-address' , $address )){
//            return response()->json(['message' => 'Forbidden'] , 403);
//        }

        $address->update($request->validated());
        return response()->json(['message' => 'Address Updated successfully!' , 'data' => AddressResource::make($address) ]);
    }
}
