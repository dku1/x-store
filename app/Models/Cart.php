<?php

namespace App\Models;

use App\Services\CartService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['session_id'];

    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class)->withPivot('quantity');
    }

    public function coupons(): BelongsToMany
    {
        return $this->belongsToMany(Coupon::class, 'cart_coupon');
    }

    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }

    public function isEmpty(): bool
    {
        return $this->positions->count() === 0;
    }

    public static function getBySessionOrCreate()
    {
        $sessionId = session()->getId();
        $cart = self::where('session_id', $sessionId)->first();
        return $cart ?? self::create(['session_id' => $sessionId]);
    }

    public function getFullPositionPrice(Position $position, Currency $currency = null): float|int
    {
        $pivotRow = $this->positions->where('id', $position->id)->first()->pivot;
        if (is_null($currency)){
            return $pivotRow->quantity * $position->convert(Currency::current()->first());
        }else{
            return $pivotRow->quantity * $position->convert($currency);
        }
    }

    public function getFullPrice(Currency $currency = null): float|int
    {
        $fullPrice = 0;
        foreach ($this->positions as $position){
            $fullPrice += $this->getFullPositionPrice($position, $currency);
        }
        if ($this->coupons->count() > 0){
             foreach ($this->coupons as $coupon){
                 $fullPrice = (new CartService())->recalculation($fullPrice, $coupon);
             }
        }
        return $fullPrice;
    }

    public static function changeSum($changePrice)
    {
        $sum = session('cart_full_sum') + $changePrice;
        session(['cart_full_sum' => $sum]);
    }
}
