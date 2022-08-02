<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;

class CartService
{
    public function add(Cart $cart, Product $product)
    {
        if ($cart->products->contains($product)) {
            $pivotRow = $cart->products->where('id', $product->id)->first()->pivot;
            $pivotRow->quantity++;
            $pivotRow->save();
        } else {
            $cart->products()->attach($product);
        }
    }
}
