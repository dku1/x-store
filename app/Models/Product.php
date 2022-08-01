<?php

namespace App\Models;

use App\Models\Traits\Localization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, Localization, SoftDeletes;

    protected $fillable = ['title_ru', 'title_en', 'image', 'description', 'price', 'old_price', 'category_id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function values(): BelongsToMany
    {
        return $this->belongsToMany(Value::class);
    }

    public function options(): HasManyThrough
    {
        return $this->hasManyThrough(Option::class,Value::class, 'option_id', 'id');
    }

    public function convert(Currency $currency): float|int
    {
        return round($this->price * $currency->rate, 2);
    }
}
