<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Position;

class CartService
{
    public function add(Cart $cart, Position $position): bool
    {
        if (!$position->available() or !$position->removeCount(1)) {
            return false;
        }
        if ($cart->positions->contains($position)) {
            $pivotRow = $this->getPivotRow($cart, $position);
            $pivotRow->quantity++;
            $pivotRow->save();
        } else {
            $cart->positions()->attach($position);
        }
        Cart::changeSum($position->price);
        return true;
    }

    public function remove(Cart $cart, Position $position): bool
    {
        if (!$cart->positions->contains($position)) {
            return false;
        }
        $pivotRow = $this->getPivotRow($cart, $position);
        if ($pivotRow->quantity == 1) {
            $cart->positions()->detach($position);
        } else {
            $pivotRow->quantity--;
            $pivotRow->save();
        }
        $position->increaseCount(1);
        Cart::changeSum(-$position->price);
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
            return $price;
        } else {
            return round($price - $discount, 2);
        }
    }

    public function getPivotRow(Cart $cart, Position $position)
    {
        return $cart->positions->where('id', $position->id)->first()->pivot;
    }

}
