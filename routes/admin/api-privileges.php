<?php

// $this->group(['middleware' => ['jwt.auth']], function () {

	// $this->resource('privileges', 'Api\V1\Admin\PrivilegeController')->only([
	//     'index', 'show'
	// ]);

// });


$this->resource('privileges', 'Api\V1\Admin\PrivilegeController')->only([
    'index', 'show'
]);