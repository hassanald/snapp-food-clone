<?php

namespace App\Http\Resources;

use App\Models\CartItem;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'items' => CartItemResource::collection($this->whenLoaded('cartItems')),
            'restaurant' => RestaurantResource::make($this->whenLoaded('restaurant')),
        ];
    }
}
