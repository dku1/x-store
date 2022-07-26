<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title_ru' => $this->faker->word,
            'title_en' => $this->faker->word,
            'image' => "https://loremflickr.com/200/200",
            'parent_id' => Category::get()->count() < 10 ? 0 : Category::get()->random()->id,
        ];
    }
}
