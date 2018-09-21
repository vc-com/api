<?php

namespace App\Providers;

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
    protected $namespace = 'App\Http\Controllers';

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

        $this->mapApiAdminAuthRoutes();
        $this->mapApiUsersRoutes();
        $this->mapApiRolesRoutes();
        $this->mapApiPrivilegesRoutes();
        $this->mapApiBannersRoutes();

    }

    /**
     * Define the "adm/users" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiUsersRoutes()
    {
        $this->prefix('/v1/admin')
             ->as('admin.')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/admin/api-users.php'));
    }

    /**
     * Define the "roles" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRolesRoutes()
    {
        $this->prefix('/v1/admin')
            ->as('admin.')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/api-roles.php'));
    }

    /**
     * Define the "privileges" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiPrivilegesRoutes()
    {
        $this->prefix('/v1/admin')
            ->as('admin.')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/api-privileges.php'));
    }


    /**
     * Define the "banners" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiBannersRoutes()
    {
        $this->prefix('/v1/admin')
            ->as('admin.')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/api-banners.php'));
    }

    /**
     * Define the "auth" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiAdminAuthRoutes()
    {
        $this->prefix('/v1/auth')
            ->as('admin.')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin/api-auth.php'));
    }


}
