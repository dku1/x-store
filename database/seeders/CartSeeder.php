<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carts = Cart::factory(50)->create();
        $coupons = Coupon::get();
        $positions = Position::get();
        foreach ($carts as $cart) {
            $cart->coupons()->attach($coupons->random(rand(0,5)));
            $cart->positions()->attach($positions->random(rand(1,10)));
        }
    }
}
