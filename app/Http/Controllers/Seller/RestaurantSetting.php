<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantSettingUpdateRequest;
use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RestaurantSetting extends Controller
{

    public function index(){
        $restaurants = Restaurant::with('user' , 'images' , 'category')
            ->where('user_id' , auth()->user()->id)->paginate(5);
        return view('seller.setting.index' , compact('restaurants'));
    }

    public function edit(Restaurant $restaurant){
        $categories = RestaurantCategory::all();
        $schedule = json_decode($restaurant->schedule , 5);

        return view('seller.setting.edit' ,[
            'restaurant' => $restaurant->load('user' , 'images' , 'category'),
            'categories' => $categories,
            'schedule' => $schedule
        ]);
    }

    public function update(Restaurant $restaurant ,RestaurantSettingUpdateRequest $request){
        $schedule = [
            'saturday' => [
                'from' => $request->saturday['from'],
                'to' => $request->saturday['to'],
            ],
            'sunday' => [
                'from' => $request->sunday['from'],
                'to' => $request->sunday['to'],
            ],
            'monday' => [
                'from' => $request->monday['from'],
                'to' => $request->monday['to'],
            ],
            'tuesday' => [
                'from' => $request->tuesday['from'],
                'to' => $request->tuesday['to'],
            ],
            'wednesday' => [
                'from' => $request->wednesday['from'],
                'to' => $request->wednesday['to'],
            ],
            'thursday' => [
                'from' => $request->thursday['from'],
                'to' => $request->thursday['to'],
            ],
            'friday' => [
                'from' => $request->friday['from'],
                'to' => $request->friday['to'],
            ],
        ];

        $schedule = json_encode($schedule);
        $schedule = str_replace("\\" , '' ,$schedule);

        $restaurant->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'acc_number' => $request->acc_number,
            'restaurant_category_id' => $request->restaurant_category_id,
            'is_open' => $request->is_open ?? 0,
            'schedule' => $schedule ?? null,
            'latitude' => $request->latitude ?? null,
            'longitude' => $request->longitude ?? null,
        ]);

        return redirect()->back()->with('success' , 'Updated successfully!');
    }
}
