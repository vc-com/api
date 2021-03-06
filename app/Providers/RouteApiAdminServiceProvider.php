<?php

namespace VoceCrianca\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteApiAdminServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'VoceCrianca\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {

        $this->mapApiAuthRoutes();
        $this->mapApiAdminAuthRoutes();
        $this->mapApiUsersRoutes();
        $this->mapApiRolesRoutes();
        $this->mapApiPrivilegesRoutes();
        $this->mapApiBannersRoutes();
        $this->mapApiBrandsRoutes();
        $this->mapApiCategoriesRoutes();
        $this->mapApiPagesRoutes();
        $this->mapApiCustomersRoutes();
        $this->mapApiCouponsRoutes();
        $this->mapApiAttributesRoutes();
        $this->mapApiProductsRoutes();

    }

    protected function mapApiUsersRoutes()
    {
        $this->prefix('/v1/admin')
             ->as('admin.')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/admin/api-users.php'));
    }

    protected function mapApiAuthRoutes()
    {
        $this->prefix('/v1/admin')
             ->as('admin.')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/admin/api-auth.php'));
    }

    protected function mapApiRolesRoutes()
    {
        $this->prefix('/v1/admin')
            ->as('admin.')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/api-roles.php'));
    }

    protected function mapApiPrivilegesRoutes()
    {
        $this->prefix('/v1/admin')
            ->as('admin.')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/api-privileges.php'));
    }

    protected function mapApiBannersRoutes()
    {
        $this->prefix('/v1/admin')
            ->as('admin.')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/api-banners.php'));
    }

    protected function mapApiBrandsRoutes()
    {
        $this->prefix('/v1/admin')
            ->as('admin.')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/api-brands.php'));
    }

    protected function mapApiCategoriesRoutes()
    {
        $this->prefix('/v1/admin')
            ->as('admin.')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/api-categories.php'));
    }

    protected function mapApiPagesRoutes()
    {
        $this->prefix('/v1/admin')
            ->as('admin.')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/api-pages.php'));
    }

    protected function mapApiCustomersRoutes()
    {
        $this->prefix('/v1/admin')
            ->as('admin.')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/api-customers.php'));
    }

    protected function mapApiCouponsRoutes()
    {
        $this->prefix('/v1/admin')
            ->as('admin.')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/api-coupons.php'));
    }

    protected function mapApiAttributesRoutes()
    {
        $this->prefix('/v1/admin')
            ->as('admin.')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/api-attributes.php'));
    }

    protected function mapApiProductsRoutes()
    {
        $this->prefix('/v1/admin')
            ->as('admin.')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/api-products.php'));
    }

    protected function mapApiAdminAuthRoutes()
    {
        $this->prefix('/v1/auth')
            ->as('admin.')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/api-auth.php'));
    }


}
