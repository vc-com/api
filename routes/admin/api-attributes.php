<?php

$this->group(['middleware' => ['jwt.auth']], function () {

    $this->resource('attributes', 'Api\V1\Admin\AttributeController')->except([
        'create', 'edit'
    ]);

    $this->resource('attributes.variations', 'Api\V1\Admin\AttributeVariationController')->except([
        'create', 'edit'
    ]);

});
