<?php

namespace App\Models;

use App\Models\Traits\Localization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Category extends Model
{
    use HasFactory, Localization;

    protected $fillable = ['title_ru', 'title_en', 'parent_id'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function availableForRemoval(): bool
    {
        return $this->children->count() === 0 and $this->products->count() === 0;
    }

    public function positions(): HasManyThrough
    {
        return $this->hasManyThrough(Position::class, Product::class, 'category_id', 'product_id', 'id', 'id');
    }

    public function getChildrenIds(): array
    {
        $ids = [];
        foreach ($this->children as $child) {
            if (isset($child->children)) {
                $ids = array_merge($ids, $child->getChildrenIds());
            }
            $ids[] = $child->id;
        }
        return $ids;
    }
}
