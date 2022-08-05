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

    protected $fillable = ['title_ru', 'title_en', 'image', 'description', 'price', 'old_price', 'category_id', 'count'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function available(): bool
    {
        return $this->count >= 1;
    }

    public function values(): BelongsToMany
    {
        return $this->belongsToMany(Value::class);
    }

    public function options(): HasManyThrough
    {
        return $this->hasManyThrough(Option::class,Value::class, 'option_id', 'id');
    }

    public function convert(Currency $currency, $old = false): float|int
    {
        if ($old and isset($this->old_price)){
            return round($this->old_price * $currency->rate, 2);
        }else{
            return round($this->price * $currency->rate, 2);
        }
    }
}
