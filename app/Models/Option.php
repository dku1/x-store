<?php

namespace App\Models;

use App\Models\Traits\Localization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Option extends Model
{
    use HasFactory, SoftDeletes, Localization;

    protected $fillable = ['title_ru', 'title_en'];

    public function values(): HasMany
    {
        return $this->hasMany(Value::class);
    }

    public function products(): Collection
    {
        $products = collect();
        $this->values->map(function ($item) use (&$products){
             foreach ($item->products as $product)  $products->push($product);
        });
        return $products;
    }
}
