<?php

// $this->group(['middleware' => ['jwt.auth']], function () {


// });


$this->resource('products', 'Api\V1\Admin\ProductController')->except([
    'create', 'edit'
]);

$this->resource('products.variations', 'Api\V1\Admin\ProductVariationController')->except([
    'create', 'edit'
]);

$this->resource('products.attachments', 'Api\V1\Admin\ProductAttachmentController')->except([
    'create', 'edit'
]);

$this->resource('products.attributes', 'Api\V1\Admin\ProductAttributeController')->except([
    'create', 'edit'
]);

$this->resource('products.categories', 'Api\V1\Admin\ProductCategoryController')->except([
    'create', 'edit'
]);


$this->resource('products.discounts', 'Api\V1\Admin\ProductDiscountController')->except([
    'create', 'edit'
]);

$this->resource('products.images', 'Api\V1\Admin\ProductImageController')->except([
    'create', 'edit'
]);


$this->resource('products.relateds', 'Api\V1\Admin\ProductRelatedController')->except([
    'create', 'edit'
]);

$this->resource('products.specials', 'Api\V1\Admin\ProductSpecialController')->except([
    'create', 'edit'
]);
