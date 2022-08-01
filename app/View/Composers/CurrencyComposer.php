<?php

namespace App\View\Composers;

use App\Models\Currency;
use Illuminate\View\View;

class CurrencyComposer
{
    public function compose(View $view)
    {
        $view->with([
            'currencies' => Currency::all(),
            'currentCurrency' => Currency::where('code', session('currency', 'RUB'))->first(),
        ]);
    }
}
