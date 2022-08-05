<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Currency;
use App\Models\Order;
use App\Models\Product;

class OrderService
{
    public function save(array $data, Cart $cart, Currency $currency)
    {
        $data['cart_id'] = $cart->id;
        $data['currency_id'] = $currency->id;
        if (auth()->check()) {
            $data['user_id'] = auth()->user()->id;
        }
        foreach ($cart->products as $product){
           if (!$this->removeCountProducts($product, $product->pivot->quantity))
               return false;
        }
        Order::create($data);
        session()->regenerate();
    }

    private function removeCountProducts(Product $product, int $countRemove): bool
    {
        if ($product->count >= $countRemove){
            $product->count = $product->count - $countRemove;
            $product->save();
            return true;
        }
        return false;
    }
}
