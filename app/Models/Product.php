<?php

namespace App\Models;

use App\Models\Traits\Localization;
use App\Services\CartService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, Localization, SoftDeletes;

    protected $fillable = [
        'title_ru',
        'title_en',
        'image',
        'description',
        'price',
        'old_price',
        'category_id',
        'count'
    ];

    protected $with = ['category'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(Cart::class);
    }

    public function getNumberOfSales(): int
    {
        $amount = 0;
        $carts = $this->carts()->with('order');
        foreach ($carts as $cart){
            if(isset($cart->order)){
                $amount += (new CartService())->getPivotRow($cart, $this)->quantity;
            }
        }
        return $amount;
    }

    public function available(): bool
    {
        return $this->count >= 1;
    }

    public function values(): BelongsToMany
    {
        return $this->belongsToMany(Value::class);
    }

    public function getRelatedProducts()
    {
        return self::where('category_id', $this->category_id)->where('id', '!=', $this->id)->get()->take(3);
    }

    public function options(): \Illuminate\Support\Collection
    {
        $options = collect();
        foreach ($this->values as $value) {
            $options->push($value->option);
        }
        return $options;
    }

    public function convert(Currency $currency, $old = false): float|int
    {
        if ($old and isset($this->old_price)) {
            return round($this->old_price * $currency->rate, 2);
        } else {
            return round($this->price * $currency->rate, 2);
        }
    }

    public function removeCount(int $countRemove): bool
    {
        if ($this->count < $countRemove) return false;
        $this->count = $this->count - $countRemove;
        $this->save();
        return true;
    }

    public function increaseCount(int $countIncrease): bool
    {
        $this->count = $this->count + $countIncrease;
        $this->save();
        return true;
    }
}
