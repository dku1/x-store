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
            'description' => $this->faker->text(200),
            'category_id' => Category::get()->random()->id,
        ];
    }
}
