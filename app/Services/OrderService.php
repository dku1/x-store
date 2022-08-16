<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Currency;
use App\Models\Order;

class OrderService
{
    public function save(array $data, Cart $cart)
    {
        $data['cart_id'] = $cart->id;
        $data['sum'] = session('cart_full_sum');
        $data['currency_id'] = Currency::current()->first()->id;
        if (auth()->check()) {
            $data['user_id'] = auth()->user()->id;
        }
        $this->deactivateCouponsFromCart($cart);
        Order::create($data);
        session(['cart_full_sum' => 0]);
        session()->regenerate();
    }

    private function deactivateCouponsFromCart(Cart $cart)
    {
        foreach ($cart->coupons as $coupon) {
            if ($coupon->disposable()) {
                $coupon->deactivate();
            }
        }
    }
}
