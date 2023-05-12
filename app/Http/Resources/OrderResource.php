<?php

namespace App\Http\Resources;

use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => OrderStatusResource::make($this->whenLoaded('status')),
            'price' => $this->price,
            'address' => AddressResource::make($this->whenLoaded('address')),
            'restaurant' => RestaurantResource::make($this->whenLoaded('restaurant')),
        ];
    }
}
