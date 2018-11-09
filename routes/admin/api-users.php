<?php
$this->group(['middleware' => ['jwt.auth']], function () {

	$this->resource('users', 'Api\V1\Admin\Setting\User\UserController')->except([
        'create', 'edit'
    ]);

    $this->resource('users.roles', 'Api\V1\Admin\Setting\User\UserRoleController')->except([
        'create', 'edit'
    ]);

});

$this->resource('factory', 'Api\V1\Admin\Setting\User\UserController')->except([
    'create', 'edit'
]);
