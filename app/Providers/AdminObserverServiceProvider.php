<?php

namespace VoceCrianca\Providers;

use Illuminate\Support\ServiceProvider;
use VoceCrianca\Models\User;
use VoceCrianca\Observers\Admin\UserObserver;
use VoceCrianca\Models\Product;
use VoceCrianca\Observers\Admin\ProductObserver;

class AdminObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
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
