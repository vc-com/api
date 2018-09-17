<?php

//$this->group(['middleware' => ['jwt.auth']], function () {
//    $this->resource('roles', 'Api\V1\Admin\RoleController')->only([
//        'index', 'show'
//    ]);
//});


$this->resource('roles', 'Api\V1\Admin\RoleController')->only([
    'index', 'show'
]);