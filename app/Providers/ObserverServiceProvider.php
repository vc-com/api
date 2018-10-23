<?php

namespace VoceCrianca\Providers;

use Illuminate\Support\ServiceProvider;
use VoceCrianca\Models\Product;
use VoceCrianca\Observers\Admin\ProductObserver;


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
