<?php

namespace VoceCrianca\Providers;

use VoceCrianca\Models\Attribute;
use VoceCrianca\Models\Banner;
use VoceCrianca\Models\Brand;
use VoceCrianca\Models\Coupon;
use VoceCrianca\Models\Customer;
use VoceCrianca\Models\Category;
use VoceCrianca\Models\Page;
use VoceCrianca\Models\Privilege;
use VoceCrianca\Models\Product;
use VoceCrianca\Models\Role;
use VoceCrianca\Models\User;
use VoceCrianca\Repositories\Attribute\AttributeMongodbRepository;
use VoceCrianca\Repositories\Attribute\AttributeRepositoryInterface;
use VoceCrianca\Repositories\Brand\BrandMongodbRepository;
use VoceCrianca\Repositories\Brand\BrandRepositoryInterface;
use VoceCrianca\Repositories\Coupon\CouponMongodbRepository;
use VoceCrianca\Repositories\Coupon\CouponRepositoryInterface;
use VoceCrianca\Repositories\Customer\CustomerMongodbRepository;
use VoceCrianca\Repositories\Customer\CustomerRepositoryInterface;
use VoceCrianca\Repositories\Privilege\PrivilegeMongodbRepository;
use VoceCrianca\Repositories\Privilege\PrivilegeRepositoryInterface;
use VoceCrianca\Repositories\Product\ProductMongodbRepository;
use VoceCrianca\Repositories\Product\ProductRepositoryInterface;
use VoceCrianca\Repositories\Role\RoleMongodbRepository;
use VoceCrianca\Repositories\Role\RoleRepositoryInterface;
use VoceCrianca\Repositories\User\UserMongodbRepository;
use VoceCrianca\Repositories\User\UserRepositoryInterface;
use VoceCrianca\Repositories\Banner\BannerMongodbRepository;
use VoceCrianca\Repositories\Banner\BannerRepositoryInterface;
use VoceCrianca\Repositories\Category\CategoryMongodbRepository;
use VoceCrianca\Repositories\Category\CategoryRepositoryInterface;
use VoceCrianca\Repositories\Page\PageMongodbRepository;
use VoceCrianca\Repositories\Page\PageRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(AttributeRepositoryInterface::class, function () {
            return new AttributeMongodbRepository(new Attribute());
        });

        $this->app->bind(BannerRepositoryInterface::class, function () {
            return new BannerMongodbRepository(new Banner());
        });

        $this->app->bind(BrandRepositoryInterface::class, function () {
            return new BrandMongodbRepository(new Brand());
        });

        $this->app->bind(CustomerRepositoryInterface::class, function () {
            return new CustomerMongodbRepository(new Customer());
        });    

        $this->app->bind(PrivilegeRepositoryInterface::class, function () {
            return new PrivilegeMongodbRepository(new Privilege());
        });

        $this->app->bind(RoleRepositoryInterface::class, function () {
            return new RoleMongodbRepository(new Role());
        });

        $this->app->bind(UserRepositoryInterface::class, function () {
            return new UserMongodbRepository(new User());
        });

        $this->app->bind(CategoryRepositoryInterface::class, function () {
            return new CategoryMongodbRepository(new Category());
        });

        $this->app->bind(PageRepositoryInterface::class, function () {
            return new PageMongodbRepository(new Page());
        });

        $this->app->bind(CouponRepositoryInterface::class, function () {
            return new CouponMongodbRepository(new Coupon());
        });

        $this->app->bind(ProductRepositoryInterface::class, function () {
            return new ProductMongodbRepository(new Product());
        });

    }

}
