<?php

// $this->name('roles.')->group(function () {

//     $this->group(['middleware' => ['jwt.auth']], function () {

//         $this->resource('admins', 'Role\RoleAdminController')->only([
//             'index', 'show'
//         ]);

//         $this->resource('tenants', 'Role\RoleTenantController')->only([
//             'index', 'show'
//         ]);

//         $this->resource('regulars', 'Role\RoleRegularController')->only([
//             'index', 'show'
//         ]);

//     });

// });

 $this->resource('roles', 'Api\V1\Admin\RoleController');

