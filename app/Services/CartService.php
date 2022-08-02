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

    public function remove(Cart $cart, Product $product)
    {
        if (!$cart->products->contains($product)) return false;
        if ($cart->products->where('id', $product->id)->first()->pivot->quantity == 1){
            $cart->products()->detach($product);
        } else{
            $pivotRow = $cart->products->where('id', $product->id)->first()->pivot;
            $pivotRow->quantity--;
            $pivotRow->save();
        }
    }
}
