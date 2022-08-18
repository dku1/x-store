<?php

namespace Database\Factories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $type = collect(['currency', 'percentage'])->random();
        return [
            'code' => Str::random(8),
            'value' => rand(5, 90),
            'type' => $type,
            'currency_id' => $type == 'currency' ? Currency::get()->random()->id : null,
            'disposable' => rand(0, 1),
            'end_date' => $this->faker->dateTime,
        ];
    }
}
