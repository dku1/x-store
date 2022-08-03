<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Currency;
use App\Models\Order;

class OrderService
{
    public function save(array $data, Cart $cart, Currency $currency)
    {
        $data['cart_id'] = $cart->id;
        $data['currency_id'] = $currency->id;
        if (auth()->check()) $data['user_id'] = auth()->user()->id;
        Order::create($data);
        session()->regenerate();
    }
}
