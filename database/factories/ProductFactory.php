<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title_ru' => $this->faker->sentence(rand(2,6)),
            'title_en' => $this->faker->sentence(rand(2,6)),
            'price' => $this->faker->randomFloat(4, 0, 10000),
            'description' => $this->faker->text(200),
            'image' => "https://loremflickr.com/200/200",
            'category_id' => Category::get()->random()->id,
        ];
    }
}
