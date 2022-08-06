<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;

class CartService
{
    public function add(Cart $cart, Product $product): bool
    {
        if (!$product->available() or !$product->removeCount(1)) {
            return false;
        }
        if ($cart->products->contains($product)) {
            $pivotRow = $this->getPivotRow($cart,$product);
            $pivotRow->quantity++;
            $pivotRow->save();
        } else {
            $cart->products()->attach($product);
        }
        return true;
    }

    public function remove(Cart $cart, Product $product): bool
    {
        if (!$cart->products->contains($product)) {
            return false;
        }
        $pivotRow = $this->getPivotRow($cart,$product);
        if ($pivotRow->quantity == 1) {
            $cart->products()->detach($product);
        } else {
            $pivotRow->quantity--;
            $pivotRow->save();
        }
        $product->increaseCount(1);
        return true;
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
        } else {
            return round($price - $discount, 2);
        }
    }

    private function getPivotRow(Cart $cart, Product $product)
    {
        return $cart->products->where('id', $product->id)->first()->pivot;
    }

}
