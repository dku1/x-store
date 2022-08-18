<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::get()->random();
        $cart = Cart::get()->random();
        $currency = Currency::get()->random();
        return [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'city' => $user->city,
            'address' => $user->address,
            'index' => $user->index,
            'cart_id' => $cart->id,
            'user_id' => $user->id,
            'currency_id' => $currency->id,
            'sum' => $cart->getFullPrice(),
        ];
    }
}
