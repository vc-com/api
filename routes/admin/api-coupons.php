<?php

// $this->group(['middleware' => ['jwt.auth']], function () {



// });

$this->resource('coupons', 'Api\V1\Admin\CouponController')->except([
    'create', 'edit'
]);

// $this->resource('coupons.categories', 'Api\V1\Admin\CouponCategoryController')->except([
//     'create', 'edit'
// ]);

// $this->resource('coupons.histories', 'Api\V1\Admin\CouponHistoryController')->except([
//     'create', 'edit'
// ]);

// $this->resource('coupons.products', 'Api\V1\Admin\CouponProductController')->except([
//     'create', 'edit'
// ]);