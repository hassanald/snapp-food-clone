<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'content' => $this->content,
            'answer' => $this->answer,
            'score' => $this->score,
            'author' => UserResource::make($this->whenLoaded('user')),
            'food' => $this->whenLoaded('cart', function () {
                return $this->cart->cartItems->map(function ($cartItem) {
                    return new FoodResource($cartItem->food);
                });
            }),
        ];
    }
}
