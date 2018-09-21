<?php

// $this->group(['middleware' => ['jwt.auth']], function () {

    //$this->resource('privileges', 'Api\V1\Admin\BannerController')->except([
    //    'create', 'edit'
    //]);

// });


$this->resource('banners', 'Api\V1\Admin\BannerController')->except([
    'create', 'edit'
]);
