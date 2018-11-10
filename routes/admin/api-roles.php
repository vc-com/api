<?php

$this->group(['middleware' => ['jwt.auth']], function () {
    $this->resource('roles', 'Api\V1\Admin\Setting\Permission\RoleController')->except([
        'create', 'edit'
    ]);
});
