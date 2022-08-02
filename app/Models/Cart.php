<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['session_id'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public static function getBySessionOrCreate()
    {
        $cart = self::where('session_id', session()->getId())->first();
        return $cart ?? self::create(['session_id' => session()->getId()]);
    }

    public function getFullProductPrice(Product $product): float|int
    {
        $pivotRow = $this->products->where('id', $product->id)->first()->pivot;
        return $pivotRow->quantity * $product->convert(Currency::getCurrent());
    }

    public function getFullPrice(): float|int
    {
        $fullPrice = 0;
        foreach ($this->products as $product){
            $fullPrice += $this->getFullProductPrice($product);
        }
        return $fullPrice;
    }
}
