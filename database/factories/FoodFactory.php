<?php

namespace Database\Factories;

use App\Models\Discount;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->slug,
            'raw_materials' => fake()->text(30),
            'price' => fake()->randomFloat(2 ),
            'discount_id' => Discount::all()->random()->id,
            'is_party' => null,
            'restaurant_id' => Restaurant::all()->random()->id,
        ];
    }
}
