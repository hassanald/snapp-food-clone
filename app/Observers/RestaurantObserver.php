<?php

namespace App\Observers;

use App\Models\Restaurant;
use Illuminate\Support\Facades\Http;

class RestaurantObserver
{
    /**
     * Handle the Restaurant "created" event.
     */
    public function creating(Restaurant $restaurant): void
    {
        $response = Http::withHeaders([
            'Api-Key' => 'service.4917208be0f4431a83bc708aa3f01949',
        ])->accept('application/json')->get("https://api.neshan.org/v4/geocoding?address=$restaurant->address");

        $restaurant->latitude = $response['location']['y'];
        $restaurant->longitude = $response['location']['x'];
    }

    public function created(Restaurant $restaurant): void
    {
        //
    }

    public function updating(Restaurant $restaurant): void
    {
        $response = Http::withHeaders([
            'Api-Key' => 'service.4917208be0f4431a83bc708aa3f01949',
        ])->accept('application/json')->get("https://api.neshan.org/v4/geocoding?address=$restaurant->address");

        $restaurant->latitude = $response['location']['y'];
        $restaurant->longitude = $response['location']['x'];
    }

    /**
     * Handle the Restaurant "updated" event.
     */
    public function updated(Restaurant $restaurant): void
    {
        //
    }

    /**
     * Handle the Restaurant "deleted" event.
     */
    public function deleted(Restaurant $restaurant): void
    {
        //
    }

    /**
     * Handle the Restaurant "restored" event.
     */
    public function restored(Restaurant $restaurant): void
    {
        //
    }

    /**
     * Handle the Restaurant "force deleted" event.
     */
    public function forceDeleted(Restaurant $restaurant): void
    {
        //
    }
}
