<?php
$this->group(['middleware' => ['jwt.auth']], function () {

    $this->resource('brands', 'Api\V1\Admin\Catalog\BrandController')->except([
        'create', 'edit'
    ]);

});
