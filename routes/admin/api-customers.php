<?php
// $this->group(['middleware' => ['jwt.auth']], function () {



// });

$this->resource('customers', 'Api\V1\Admin\CustomerController')->except([
 	'create', 'edit'
]);

$this->resource('customers.address', 'Api\V1\Admin\CustomerAddressController')->except([
 	'create', 'edit'
]);

$this->resource('customers.phones', 'Api\V1\Admin\CustomerPhoneController')->except([
 	'create', 'edit'
]);
