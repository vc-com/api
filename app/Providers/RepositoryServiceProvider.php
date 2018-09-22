<?php

namespace App\Providers;

use App\Entities\Banner;
use App\Entities\Brand;
use App\Entities\Category;
use App\Entities\Privilege;
use App\Entities\Role;
use App\Entities\User;
use App\Repositories\Brand\BrandMongodbRepository;
use App\Repositories\Brand\BrandRepositoryInterface;
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

        $this->app->bind(PrivilegeRepositoryInterface::class, function () {
            return new PrivilegeMongodbRepository(new Privilege());
        });

        $this->app->bind(RoleRepositoryInterface::class, function () {
            return new RoleMongodbRepository(new Role());
        });

        $this->app->bind(UserRepositoryInterface::class, function () {
            return new UserMongodbRepository(new User());
        });

        $this->app->bind(BannerRepositoryInterface::class, function () {
            return new BannerMongodbRepository(new Banner());
        });

        $this->app->bind(BrandRepositoryInterface::class, function () {
            return new BrandMongodbRepository(new Brand());
        });

        $this->app->bind(CategoryRepositoryInterface::class, function () {
            return new CategoryMongodbRepository(new Category());
        });

    }

}
