<?php

namespace Database\Factories;

use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $positions = Position::get();
        $users = User::get();
        return [
            'position_id' => $positions->random()->id,
            'user_id' => $users->random()->id,
            'message' => $this->faker->text(100),
        ];
    }
}
