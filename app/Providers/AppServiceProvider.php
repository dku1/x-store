<?php

namespace App\Providers;

use App\Http\Controllers\OrderController;
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
        $this->app->bind(Currency::class, function ($app){
            return Currency::getCurrent();
        });
    }
}
