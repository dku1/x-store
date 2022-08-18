<?php

namespace App\Models;

use App\Models\Traits\Filter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use HasFactory, SoftDeletes, Filter;

    protected $fillable = ['product_id', 'price', 'old_price', 'count', 'image'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(Cart::class)->withPivot('quantity');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class)->orderBy('created_at', 'desc');
    }

    public function values(): BelongsToMany
    {
        return $this->belongsToMany(Value::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function available(): bool
    {
        return $this->count >= 1;
    }

    public function convert(Currency $currency, $old = false): float|int
    {
        if ($old and isset($this->old_price)) {
            return round($this->old_price * $currency->rate, 2);
        } else {
            return round($this->price * $currency->rate, 2);
        }
    }

    public function getRelated()
    {
        return self::product($this->product_id)
            ->where('id', '!=', $this->id)->get()->take(3);
    }

    public function removeCount(int $countRemove): bool
    {
        if ($this->count < $countRemove) {
            return false;
        }
        $this->count = $this->count - $countRemove;
        $this->save();
        return true;
    }

    public function scopeByCategory($query, Category $category)
    {
        $ids = array_merge([$category->id], $category->getChildrenIds());
        return $query->whereHas('product', function (Builder $query) use ($ids) {
            $query->whereIn('category_id', $ids);
        });
    }

    public function increaseCount(int $countIncrease): bool
    {
        $this->count = $this->count + $countIncrease;
        $this->save();
        return true;
    }

    public function scopeProduct($query, Product $product)
    {
        return $query->where('product_id', $product->id);
    }
}
