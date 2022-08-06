<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Currency;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(Cart::class, function ($app){
            return Cart::getBySessionOrCreate();
        });
    }
}
