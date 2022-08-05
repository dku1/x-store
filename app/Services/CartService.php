<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Coupon;
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
        if ($cart->products->where('id', $product->id)->first()->pivot->quantity == 1) {
            $cart->products()->detach($product);
        } else {
            $pivotRow = $cart->products->where('id', $product->id)->first()->pivot;
            $pivotRow->quantity--;
            $pivotRow->save();
        }
    }

    public function recalculation($price, Coupon $coupon): float|int
    {
        if ($coupon->isPercentage()) {
            return $this->percentageRecalculation($price, $coupon->value);
        } else {
            return $this->currencyRecalculation($price, $coupon);
        }
    }

    public function percentageRecalculation($price, $value): float|int
    {
        $discount = ($price * $value) / 100;
        return round($price - $discount, 2);
    }

    public function currencyRecalculation($price, Coupon $coupon)
    {
        $discount = (new CurrencyService())->convert($coupon->value);
        if ($price < $discount) {
            session()->flash('warning', 'Купон неприменим');
            return $price;
        }else{
            return round($price - $discount, 2);
        }
    }

}
