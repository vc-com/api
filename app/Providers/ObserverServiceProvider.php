<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Entities\Product;
use App\Observers\Admin\ProductObserver;


class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Product::observe(ProductObserver::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
