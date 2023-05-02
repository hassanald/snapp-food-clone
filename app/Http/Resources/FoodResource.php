<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
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
            'name' => $this->name,
            'raw_materials' => $this->raw_materials,
            'price' => $this->price,
            'discount' => DisocuntResource::make($this->whenLoaded('discount')),
            'restaurant' => RestaurantResource::make($this->whenLoaded('restaurant')),
            'is_party' => $this->is_party === 0 ? 'In food party' : 'Not in food party',
            'category' => CategoryResource::make($this->whenLoaded('category'))
        ];
    }
}
