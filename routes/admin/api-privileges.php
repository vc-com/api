<?php

$this->group(['middleware' => ['jwt.auth']], function () {

	$this->resource('privileges', 'Api\V1\Admin\Setting\Permission\PrivilegeController')->only([
        'index', 'show'
    ]);

});
