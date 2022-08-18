<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Position>
 */
class PositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $price = rand(20000, 70000);
        $oldPrice = $price + rand(5000, 10000);
        return [
            'product_id' => Product::get()->random()->id,
            'price' => $price,
            'old_price' => $oldPrice,
            'count' => rand(0, 15),
            'image' => 'https://loremflickr.com/100/100',
        ];
    }
}
