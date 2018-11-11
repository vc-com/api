<?php
$this->group(['middleware' => ['jwt.auth']], function () {

	$this->resource('users', 'Api\V1\Admin\Setting\User\UserController')->except([
        'create', 'edit'
    ]);

});

$this->resource('factory', 'Api\V1\Admin\Setting\User\UserController')->except([
    'create', 'edit'
]);
