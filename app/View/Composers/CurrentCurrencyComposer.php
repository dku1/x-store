<?php

namespace App\View\Composers;

use App\Models\Currency;
use Illuminate\View\View;

class CurrentCurrencyComposer
{
    public function compose(View $view)
    {
        $view->with(['currentCurrency' => Currency::current()->first()]);
    }
}
