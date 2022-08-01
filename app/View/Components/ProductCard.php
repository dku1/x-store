<?php

namespace App\View\Components;

use App\Models\Currency;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductCard extends Component
{
    public Product $product;

    public Currency $currentCurrency;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Product $product, Currency $currentCurrency)
    {
        $this->product = $product;
        $this->currentCurrency = $currentCurrency;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|string|Closure
    {
        return view('components.product-card');
    }
}
