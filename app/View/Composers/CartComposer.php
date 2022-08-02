<?php

namespace App\View\Composers;

use App\Models\Cart;
use Illuminate\View\View;

class CartComposer
{
    public function compose(View $view)
    {
        $view->with(['cart' => Cart::getBySessionOrCreate()]);
    }
}
