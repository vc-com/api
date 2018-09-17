<?php
// $this->group(['middleware' => ['jwt.auth']], function () {

// 	$this->resource('/users', 'Api\V1\Admin\UserController')->except([
// 		'create', 'edit'
// 	]);

// });

$this->resource('/users', 'Api\V1\Admin\UserController')->except([
 	'create', 'edit'
]);
