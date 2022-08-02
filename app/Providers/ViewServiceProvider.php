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
        View::composer('layouts.master', AllCurrencyComposer::class);
        View::composer(['layouts.master', 'product.index', 'category.index', 'components.cart'], CurrentCurrencyComposer::class);
        View::composer('components.cart', CartComposer::class);
    }
}
