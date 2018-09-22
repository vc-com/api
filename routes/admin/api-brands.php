<?php

// $this->group(['middleware' => ['jwt.auth']], function () {


// 	$this->resource('brands', 'Api\V1\Admin\BrandController')->except([
// 	    'create', 'edit'
// 	]);


// });

$this->resource('brands', 'Api\V1\Admin\BrandController')->except([
    'create', 'edit'
]);