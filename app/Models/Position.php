<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['product_id', 'price', 'old_price', 'count', 'image'];

    protected $with = ['product'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function values(): BelongsToMany
    {
        return $this->belongsToMany(Value::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filters): Builder
    {
        return $filters->apply($builder);
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
        return self::where('product_id', $this->product_id)
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
        $ids = $this->getChildrenIds($category);
        return $query->whereHas('product', function (Builder $query) use ($category, $ids) {
            $query->where('category_id', $category->id)->orWhereIn('category_id', $ids);
        });
    }

    public function increaseCount(int $countIncrease): bool
    {
        $this->count = $this->count + $countIncrease;
        $this->save();
        return true;
    }

    private function getChildrenIds(Category $category): array
    {
        $ids = [];
        foreach ($category->children as $child){
            if (isset($child->children)){
               $ids = array_merge($ids, $this->getChildrenIds($child));
            }
            $ids[] = $child->id;
        }
        return $ids;
    }
}
