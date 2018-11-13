<?php

$this->group(['middleware' => ['jwt.auth']], function () {

    $this->resource('attributes', 'Api\V1\Admin\Catalog\AttributeController')->except([
        'create', 'edit'
    ]);

    $this->resource('attributes.variations', 'Api\V1\Admin\Catalog\AttributeVariationController')->except([
        'create', 'edit'
    ]);

});
