<?php

namespace App\Providers;

use App\Entities\Banner;
use App\Entities\Brand;
use App\Entities\Customer;
use App\Entities\CustomerAddress;
use App\Entities\CustomerPhone;
use App\Entities\Category;
use App\Entities\CategoryParent;
use App\Entities\Page;
use App\Entities\Privilege;
use App\Entities\Role;
use App\Entities\User;
use App\Repositories\Brand\BrandMongodbRepository;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Customer\CustomerMongodbRepository;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\CustomerAddress\CustomerAddressMongodbRepository;
use App\Repositories\CustomerAddress\CustomerAddressRepositoryInterface;
use App\Repositories\CustomerPhone\CustomerPhoneMongodbRepository;
use App\Repositories\CustomerPhone\CustomerPhoneRepositoryInterface;
use App\Repositories\Privilege\PrivilegeMongodbRepository;
use App\Repositories\Privilege\PrivilegeRepositoryInterface;
use App\Repositories\Role\RoleMongodbRepository;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserMongodbRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Banner\BannerMongodbRepository;
use App\Repositories\Banner\BannerRepositoryInterface;
use App\Repositories\Category\CategoryMongodbRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\CategoryParent\CategoryParentMongodbRepository;
use App\Repositories\CategoryParent\CategoryParentRepositoryInterface;
use App\Repositories\Page\PageMongodbRepository;
use App\Repositories\Page\PageRepositoryInterface;
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

        $this->app->bind(CategoryParentRepositoryInterface::class, function () {
            return new CategoryParentMongodbRepository(new CategoryParent());
        });

        $this->app->bind(PageRepositoryInterface::class, function () {
            return new PageMongodbRepository(new Page());
        });

    }

}
