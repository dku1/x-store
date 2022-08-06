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

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
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
        return $this->products->count() === 0;
    }

    public static function getBySessionOrCreate()
    {
        $cart = self::where('session_id', session()->getId())->first();
        return $cart ?? self::create(['session_id' => session()->getId()]);
    }

    public function getFullProductPrice(Product $product, Currency $currency = null): float|int
    {
        $pivotRow = $this->products->where('id', $product->id)->first()->pivot;
        if (is_null($currency)){
            return $pivotRow->quantity * $product->convert(Currency::getCurrent());
        }else{
            return $pivotRow->quantity * $product->convert($currency);
        }
    }

    public function getFullPrice(Currency $currency = null): float|int
    {
        $fullPrice = 0;
        foreach ($this->products as $product){
            $fullPrice += $this->getFullProductPrice($product, $currency);
        }
        if ($this->coupons->count() > 0){
             foreach ($this->coupons as $coupon){
                 $fullPrice = (new CartService())->recalculation($fullPrice, $coupon);
             }
        }
        return $fullPrice;
    }
}
