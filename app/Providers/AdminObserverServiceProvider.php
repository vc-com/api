<?php

namespace VoceCrianca\Providers;

use Illuminate\Support\ServiceProvider;
use VoceCrianca\Models\User;
use VoceCrianca\Observers\Admin\Settings\UserObserver;
use VoceCrianca\Models\Product;
use VoceCrianca\Observers\Admin\Catalogs\ProductObserver;
use VoceCrianca\Models\Brand;
use VoceCrianca\Observers\Admin\Catalogs\BrandObserver;

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
        //Brand::observe(BrandObserver::class);
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
