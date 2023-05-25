<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
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
            'phone' => $this->phone,
            'address' => $this->address,
            'acc_number' => implode("-" , str_split($this->acc_number , 4)),
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'open' => $this->is_open === 1 ? 'Open' : 'Close',
            'schedule' => json_decode($this->schedule , 5),
            'owner' => UserResource::make($this->whenLoaded('user'))
        ];
    }
}
