<?php

namespace App\View\Composers;

use App\Models\Currency;
use Illuminate\View\View;

class AllCurrencyComposer
{
    public function compose(View $view)
    {
        $view->with(['currencies' => Currency::all()]);
    }
}
