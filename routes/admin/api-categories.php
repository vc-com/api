<?php

// $this->group(['middleware' => ['jwt.auth']], function () {

    //$this->resource('categories', 'Api\V1\Admin\CategoryController')->except([
    //    'create', 'edit'
    //]);

// });


$this->resource('categories', 'Api\V1\Admin\CategoryController')->except([
    'create', 'edit'
]);

$this->resource('categories.parents', 'Api\V1\Admin\CategoryParentController')->except([
    'create', 'edit'
]);
