<?php

// $this->group(['middleware' => ['jwt.auth']], function () {

    //$this->resource('pages', 'Api\V1\Admin\PageController')->except([
    //    'create', 'edit'
    //]);

// });


$this->resource('pages', 'Api\V1\Admin\PageController')->except([
    'create', 'edit'
]);