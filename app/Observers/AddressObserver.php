<?php

namespace App\Observers;

use App\Models\Address;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Http;

class AddressObserver
{
    public function creating(Address $address): void
    {
        $response = Http::withHeaders([
            'Api-Key' => 'service.4917208be0f4431a83bc708aa3f01949',
        ])->accept('application/json')->get("https://api.neshan.org/v4/geocoding?address=$address->address");

        $address->latitude = $response['location']['y'];
        $address->longitude = $response['location']['x'];
    }

    /**
     * Handle the Address "created" event.
     */
    public function created(Address $address): void
    {
        //
    }

    public function updating(Address $address): void
    {
        $response = Http::withHeaders([
            'Api-Key' => 'service.4917208be0f4431a83bc708aa3f01949',
        ])->accept('application/json')->get("https://api.neshan.org/v4/geocoding?address=$address->address");

        $address->latitude = $response['location']['y'];
        $address->longitude = $response['location']['x'];
    }

    /**
     * Handle the Address "updated" event.
     */
    public function updated(Address $address): void
    {
        //
    }

    /**
     * Handle the Address "deleted" event.
     */
    public function deleted(Address $address): void
    {
        //
    }

    /**
     * Handle the Address "restored" event.
     */
    public function restored(Address $address): void
    {
        //
    }

    /**
     * Handle the Address "force deleted" event.
     */
    public function forceDeleted(Address $address): void
    {
        //
    }
}
