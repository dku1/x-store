<?php

namespace App\Providers;

use App\View\Composers\AllCurrencyComposer;
use App\View\Composers\CartComposer;
use App\View\Composers\CurrentCurrencyComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('nav', AllCurrencyComposer::class);
        View::composer(['position.index', 'category.index', 'cart.index', 'order.create', 'position.show', 'nav'], CurrentCurrencyComposer::class);
    }
}
