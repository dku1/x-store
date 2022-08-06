<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Currency;
use App\Models\Order;
use App\Models\Product;

class OrderService
{
    public function save(array $data, Cart $cart)
    {
        $data['cart_id'] = $cart->id;
        $data['currency_id'] = Currency::getCurrent()->id;
        if (auth()->check()) {
            $data['user_id'] = auth()->user()->id;
        }
        Order::create($data);
        session()->regenerate();
    }
}
